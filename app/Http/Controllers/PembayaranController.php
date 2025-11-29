<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Akunbank;
use App\Models\Muzaki;
use App\Models\Pembayaran;
use App\Models\Zakat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'petugas_upz') {
            $pembayarans = Pembayaran::where('upz_id', session('upz_id'))->with(['muzaki']);
        } else {
            $pembayarans = Pembayaran::with(['muzaki']);
        }

        $search = request('search');

        if (request('search')) {
            $pembayarans->when($search, function ($query, $search) {
                $query->where('jenis_pembayaran', 'like', '%' . $search . '%')
                    ->orWhere('metode_bayar', 'like', '%' . $search . '%')
                    ->orWhere('nilai_ukur', 'like', '%' . $search . '%')
                    ->orWhere('jumlah_keluarga', 'like', '%' . $search . '%')
                    ->orWhere('total', 'like', '%' . $search . '%')

                    // Relasi ke muzaki
                    ->orWhereHas('muzaki', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    });
            })
                ->latest();
        }

        $pembayarans = $pembayarans->paginate(10)->appends(['search' => $search]);

        return view('pembayaran.index', compact('pembayarans', 'search'));
    }

    public function create()
    {
        $muzakis = Muzaki::where('upz_id', session('upz_id'))->get();
        $zakats = Zakat::all();

        return view('pembayaran.create', compact('muzakis', 'zakats'));
    }

    public function zakat($id)
    {
        $zakat = Zakat::findOrFail($id);

        return response()->json([
            'nama_sumbangan' => $zakat->nama_sumbangan,
            'jenis_benda' => $zakat->jenis_benda,
            'nilai_ukuran' => $zakat->nilai_ukuran,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'muzaki_id' => 'required',
            'zakat_id' => 'required',
            'tgl_bayar' => 'required',
            'jenis_pembayaran' => 'required',
            'metode_bayar' => 'required',
            'nilai_ukur' => 'required',
            'jumlah_keluarga' => 'required',
            'total' => 'required',
        ]);

        $validatedData['upz_id'] = session('upz_id');
        $validatedData['amil_id'] = session('amil_id');
        $validatedData['tgl_bayar'] = Carbon::parse($request->tgl_bayar)->format('Y-m-d');

        Pembayaran::create($validatedData);

        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $muzakis = Muzaki::where('upz_id', session('upz_id'))->get();
        $zakats = Zakat::all();
        $pembayaran = Pembayaran::findOrFail($id);
        $tanggalFormatted = Carbon::parse($pembayaran->tgl_bayar)->format('m/d/Y');

        return view('pembayaran.edit', compact('muzakis', 'zakats', 'pembayaran', 'tanggalFormatted'));
    }

    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validatedData = $request->validate([
            'muzaki_id' => 'required',
            'zakat_id' => 'required',
            'tgl_bayar' => 'required',
            'jenis_pembayaran' => 'required',
            'metode_bayar' => 'required',
            'nilai_ukur' => 'required',
            'jumlah_keluarga' => 'required',
            'total' => 'required',
        ]);

        $validatedData['upz_id'] = session('upz_id');
        $validatedData['amil_id'] = session('amil_id');
        $validatedData['tgl_bayar'] = Carbon::parse($request->tgl_bayar)->format('Y-m-d');

        $pembayaran->update($validatedData);

        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function bayarZakatCreate()
    {
        $zakats = Zakat::all();
        $akunbanks = Akunbank::all();

        return view('pembayaran.bayarzakat', compact('zakats', 'akunbanks'));
    }

    public function bayarZakatStore(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_rumah' => 'required',
            'pekerjaan' => 'required',
            'alamat_kantor' => 'required',
            'telepon' => 'required',
            'email' => 'required|email:dns',
        ]);

        $validatedData['upz_id'] = 1;

        $muzaki = Muzaki::create($validatedData);

        $validatedDataBayar = $request->validate([
            'zakat_id' => 'required',
            'akunbank_id' => 'required',
            'total' => 'required',
        ]);

        $zakat = Zakat::findOrFail($request->zakat_id);

        $validatedDataBayar['jenis_pembayaran'] = $zakat->nama_sumbangan;
        $validatedDataBayar['metode_bayar'] = $zakat->jenis_benda;
        $validatedDataBayar['nilai_ukur'] = $zakat->nilai_ukuran;
        $validatedDataBayar['jumlah_keluarga'] = 1;
        $validatedDataBayar['muzaki_id'] = $muzaki->id;
        $validatedDataBayar['tgl_bayar'] = Carbon::parse(now())->format('Y-m-d');
        $validatedDataBayar['upz_id'] = 1;
        $validatedDataBayar['amil_id'] = 2;
        $validatedDataBayar['tgl_bayar'] = now()->format('Y-m-d');

        $tanggal = now()->format('d/m/y');
        $angkaRomawi = array(
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII'
        );

        $bulan = date('m');
        $kodeBulan = $angkaRomawi[$bulan];
        // Cek jumlah pembayaran pada hari yang sama
        $countToday = Pembayaran::whereDate('created_at', now()->toDateString())->count() + 1;

        $kodeUrut = str_pad($countToday, 6, '0', STR_PAD_LEFT); // jadikan 0000001, 0000002, dst
        $kode_pembayaran = $tanggal . '/' . 'PZ/' . $kodeBulan . '/' .  $kodeUrut;

        $validatedDataBayar['kode_pembayaran'] = $kode_pembayaran;

        $pembayaran = Pembayaran::create($validatedDataBayar);

        return redirect()->route('bayarzakat.upload', $pembayaran->id)
            ->with('success', 'Pembayaran zakat berhasil dibuat. Silakan upload bukti transfer.');
    }

    public function uploadBukti($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.upload', compact('pembayaran'));
    }

    public function storeBukti(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('bukti-transfer');
        }

        $pembayaran->update($validatedData);

        return redirect()->route('bayarzakat.invoice', $pembayaran->id)
            ->with('success', 'Bukti transfer berhasil diupload.');
    }

    public function invoice($id)
    {
        $pembayaran = Pembayaran::with('muzaki')->findOrFail($id);
        return view('pembayaran.invoice', compact('pembayaran'));
    }
}
