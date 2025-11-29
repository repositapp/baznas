<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mustahik;
use App\Models\Pembayaran;
use App\Models\Penyaluran;
use App\Models\Penyalurangbr;
use App\Models\Zakat;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PenyaluranController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'petugas_upz') {
            $penyalurans = Penyaluran::where('upz_id', session('upz_id'))->with(['mustahik', 'zakat']);
        } else {
            $penyalurans = Penyaluran::with(['mustahik', 'zakat']);
        }

        $search = request('search');
        if (request('search')) {
            $penyalurans->when($search, function ($query, $search) {
                $query->where('kode_penyaluran', 'like', '%' . $search . '%')
                    ->orWhere('tgl_penyaluran', 'like', '%' . $search . '%')
                    ->orWhere('total', 'like', '%' . $search . '%')

                    // Relasi ke mustahik
                    ->orWhereHas('mustahik', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%')
                            ->orWhere('anggota_keluarga', 'like', '%' . $search . '%');
                    })

                    // Relasi ke zakat
                    ->orWhereHas('zakat', function ($q) use ($search) {
                        $q->where('nama_sumbangan', 'like', '%' . $search . '%')
                            ->orWhere('jenis_benda', 'like', '%' . $search . '%');
                    });
            })
                ->latest();
        }

        $penyalurans = $penyalurans->paginate(10)->appends(['search' => $search]);

        return view('penyaluran.index', compact('penyalurans', 'search'));
    }

    public function create()
    {
        $mustahiks = Mustahik::where('upz_id', session('upz_id'))->get();
        $zakats = Zakat::all();

        return view('penyaluran.create', compact('mustahiks', 'zakats'));
    }

    public function mustahik($id)
    {
        $mustahik = Mustahik::findOrFail($id);

        $tahun = date('Y');
        $zakatIds = [1, 2];

        $sudahTerima = Penyaluran::where('mustahik_id', $id)
            ->whereYear('tgl_penyaluran', $tahun)
            ->whereIn('zakat_id', $zakatIds)
            ->exists();

        return response()->json([
            'anggota_keluarga' => $mustahik->anggota_keluarga,
            'alamat_rumah' => $mustahik->alamat_rumah,
            'sudah_terima' => $sudahTerima,
        ]);
    }

    public function zakat($id)
    {
        $zakat = Zakat::findOrFail($id);
        $totalPembayaran = Pembayaran::where('zakat_id', $id)->sum('total');
        $totalPenyaluran = Penyaluran::where('zakat_id', $id)->sum('total');

        $sisa = $totalPembayaran - $totalPenyaluran;

        return response()->json([
            'jenis_benda' => $zakat->jenis_benda,
            'sisa' => $sisa,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mustahik_id' => 'required',
            'zakat_id' => 'required',
            'tgl_penyaluran' => 'required',
            'total' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $validatedData['upz_id'] = session('upz_id');
        $validatedData['amil_id'] = session('amil_id');
        $validatedData['tgl_penyaluran'] = Carbon::parse($request->tgl_penyaluran)->format('Y-m-d');

        $penyaluran = Penyaluran::create($validatedData);

        if ($request->file('gambar')) {
            $mustahik = Mustahik::findOrFail($request->mustahik_id);
            $zakat = Zakat::findOrFail($request->zakat_id);

            $file = $request->file('gambar');
            $namaGambar = now()->toDateString() . '-' . Str::slug($zakat->nama_sumbangan) . '-' . Str::slug($mustahik->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('penyaluran_gambar', $namaGambar);

            $penyaluran->gambar()->create([
                'kode_penyaluran' => $penyaluran->kode_penyaluran,
                'nama_gambar' => $namaGambar,
                'gambar' => $path,
            ]);
        }

        return redirect()->route('penyaluran.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $mustahiks = Mustahik::where('upz_id', session('upz_id'))->get();
        $zakats = Zakat::all();

        $penyaluran = Penyaluran::findOrFail($id);
        $mustahik = Mustahik::findOrFail($penyaluran->mustahik_id);
        $zakat = Zakat::findOrFail($penyaluran->zakat_id);

        $totalPembayaran = Pembayaran::where('zakat_id', $penyaluran->zakat_id)->sum('total');
        $totalPenyaluran = Penyaluran::where('zakat_id', $penyaluran->zakat_id)->sum('total');

        $keluarga = $mustahik->anggota_keluarga;
        $alamat = $mustahik->alamat_rumah;
        $metode = $zakat->jenis_benda;
        $sisa = $totalPembayaran - $totalPenyaluran;

        $formattedSisa = $metode === 'Beras'
            ? $sisa . ' Kg'
            : 'Rp ' . number_format($sisa, 0, ',', '.');

        $tanggalFormatted = Carbon::parse($penyaluran->tgl_penyaluran)->format('m/d/Y');

        return view('penyaluran.edit', compact('mustahiks', 'zakats', 'penyaluran', 'tanggalFormatted', 'keluarga', 'alamat', 'metode', 'formattedSisa'));
    }

    public function update(Request $request, string $id)
    {
        $penyaluran = Penyaluran::with('gambar')->findOrFail($id);

        $validatedData = $request->validate([
            'mustahik_id' => 'required',
            'zakat_id' => 'required',
            'tgl_penyaluran' => 'required|date',
            'total' => 'required|numeric',
            'gambar' => 'nullable|image|file|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $validatedData['upz_id'] = session('upz_id');
        $validatedData['amil_id'] = session('amil_id');
        $validatedData['tgl_penyaluran'] = Carbon::parse($validatedData['tgl_penyaluran'])->format('Y-m-d');

        $penyaluran->update($validatedData);

        if ($request->hasFile('gambar')) {
            if ($penyaluran->gambar && $penyaluran->gambar->gambar) {
                Storage::disk('public')->delete($penyaluran->gambar->gambar);
            }

            $file = $request->file('gambar');
            $mustahik = Mustahik::findOrFail($request->mustahik_id);
            $zakat = Zakat::findOrFail($request->zakat_id);
            $namaGambar = now()->format('Ymd') . '-' . Str::slug($zakat->nama_sumbangan) . '-' . Str::slug($mustahik->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('penyaluran_gambar', $namaGambar, 'public');

            $penyaluran->gambar()->updateOrCreate(
                ['kode_penyaluran' => $penyaluran->kode_penyaluran],
                ['nama_gambar' => $namaGambar, 'gambar' => $path]
            );
        }

        return redirect()->route('penyaluran.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $penyaluran = Penyaluran::with('gambar')->findOrFail($id);

        if ($penyaluran->gambar && $penyaluran->gambar->gambar) {
            Storage::disk('public')->delete($penyaluran->gambar->gambar);
        }

        $penyaluran->gambar()->delete();
        $penyaluran->delete();

        return redirect()->route('penyaluran.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}
