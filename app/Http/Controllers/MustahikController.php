<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Golongan;
use App\Models\Mustahik;
use App\Models\Upz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MustahikController extends Controller
{
    public function index()
    {
        $search = request('search');
        if (Auth::user()->role == 'petugas_upz') {
            $mustahiks = Mustahik::where('upz_id', session('upz_id'))->latest();
        } else {
            $mustahiks = Mustahik::latest();
        }
        if (request('search')) {
            $mustahiks->where('nama', 'like', '%' . $search . '%')
                ->orWhere('alamat_rumah', 'like', '%' . $search . '%')
                ->orWhere('pekerjaan', 'like', '%' . $search . '%')
                ->orWhere('telepon', 'like', '%' . $search . '%');
        }

        $mustahiks = $mustahiks->paginate(10)->appends(['search' => $search]);

        return view('mustahik.index', compact('mustahiks', 'search'));
    }

    public function create()
    {
        $golongans = Golongan::all();
        $upzs = Upz::all();

        return view('mustahik.create', compact('upzs', 'golongans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'golongan_id' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'anggota_keluarga' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'alamat_rumah' => 'required',
        ]);

        $validatedData['upz_id'] = session('upz_id');

        if ($request->tempat_lahir) {
            $validatedData['tempat_lahir'] = $request->tempat_lahir;
        }
        if ($request->tanggal_lahir) {
            $validatedData['tanggal_lahir'] = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        }
        if ($request->keterangan) {
            $validatedData['keterangan'] = $request->keterangan;
        }
        if ($request->alamat_kantor) {
            $validatedData['alamat_kantor'] = $request->alamat_kantor;
        }
        if ($request->telepon) {
            $validatedData['telepon'] = $request->telepon;
        }
        if ($request->email) {
            $validatedData['email'] = $request->email;
        }

        Mustahik::create($validatedData);

        return redirect()->route('mustahik.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $golongans = Golongan::all();
        $upzs = Upz::all();
        $mustahik = Mustahik::findOrFail($id);
        $tanggalFormatted = Carbon::parse($mustahik->tanggal_lahir)->format('m/d/Y');

        return view('mustahik.edit', compact('golongans', 'upzs', 'mustahik', 'tanggalFormatted'));
    }

    public function update(Request $request, string $id)
    {
        $mustahik = Mustahik::findOrFail($id);

        $validatedData = $request->validate([
            'golongan_id' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'anggota_keluarga' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'alamat_rumah' => 'required',
        ]);

        $validatedData['upz_id'] = session('upz_id');

        if ($request->tempat_lahir) {
            $validatedData['tempat_lahir'] = $request->tempat_lahir;
        }
        if ($request->tanggal_lahir) {
            $validatedData['tanggal_lahir'] = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        }
        if ($request->keterangan) {
            $validatedData['keterangan'] = $request->keterangan;
        }
        if ($request->alamat_kantor) {
            $validatedData['alamat_kantor'] = $request->alamat_kantor;
        }
        if ($request->telepon) {
            $validatedData['telepon'] = $request->telepon;
        }
        if ($request->email) {
            $validatedData['email'] = $request->email;
        }

        $mustahik->update($validatedData);

        return redirect()->route('mustahik.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $mustahik = Mustahik::findOrFail($id);
        $mustahik->delete();

        return redirect()->route('mustahik.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
