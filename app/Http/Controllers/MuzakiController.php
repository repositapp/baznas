<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Muzaki;
use App\Models\Upz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuzakiController extends Controller
{
    public function index()
    {
        $search = request('search');
        if (Auth::user()->role == 'petugas_upz') {
            $muzakis = Muzaki::where('upz_id', session('upz_id'))->latest();
        } else {
            $muzakis = Muzaki::latest();
        }
        if (request('search')) {
            $muzakis->where('nama', 'like', '%' . $search . '%')
                ->orWhere('alamat_rumah', 'like', '%' . $search . '%')
                ->orWhere('pekerjaan', 'like', '%' . $search . '%')
                ->orWhere('telepon', 'like', '%' . $search . '%');
        }

        $muzakis = $muzakis->paginate(10)->appends(['search' => $search]);

        return view('muzaki.index', compact('muzakis', 'search'));
    }

    public function create()
    {
        $upzs = Upz::all();

        return view('muzaki.create', compact('upzs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'alamat_kantor' => 'required',
            'telepon' => 'required',
            'email' => 'required|email:dns',
        ]);

        $validatedData['upz_id'] = session('upz_id');

        if ($request->nik) {
            $validatedData['nik'] = $request->nik;
        }
        if ($request->tempat_lahir) {
            $validatedData['tempat_lahir'] = $request->tempat_lahir;
        }
        if ($request->tanggal_lahir) {
            $validatedData['tanggal_lahir'] = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        }
        if ($request->nip) {
            $validatedData['nip'] = $request->nip;
        }
        if ($request->keterangan) {
            $validatedData['keterangan'] = $request->keterangan;
        }
        if ($request->alamat_rumah) {
            $validatedData['alamat_rumah'] = $request->alamat_rumah;
        }

        Muzaki::create($validatedData);

        return redirect()->route('muzaki.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $upzs = Upz::all();
        $muzaki = Muzaki::findOrFail($id);
        $tanggalFormatted = Carbon::parse($muzaki->tanggal_lahir)->format('m/d/Y');

        return view('muzaki.edit', compact('upzs', 'muzaki', 'tanggalFormatted'));
    }

    public function update(Request $request, string $id)
    {
        $muzaki = Muzaki::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'alamat_kantor' => 'required',
            'telepon' => 'required',
            'email' => 'required|email:dns',
        ]);

        $validatedData['upz_id'] = session('upz_id');

        if ($request->nik) {
            $validatedData['nik'] = $request->nik;
        }
        if ($request->tempat_lahir) {
            $validatedData['tempat_lahir'] = $request->tempat_lahir;
        }
        if ($request->tanggal_lahir) {
            $validatedData['tanggal_lahir'] = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        }
        if ($request->nip) {
            $validatedData['nip'] = $request->nip;
        }
        if ($request->keterangan) {
            $validatedData['keterangan'] = $request->keterangan;
        }
        if ($request->alamat_rumah) {
            $validatedData['alamat_rumah'] = $request->alamat_rumah;
        }

        $muzaki->update($validatedData);

        return redirect()->route('muzaki.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $muzaki = Muzaki::findOrFail($id);
        $muzaki->delete();

        return redirect()->route('muzaki.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
