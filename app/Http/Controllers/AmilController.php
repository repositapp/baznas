<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Amil;
use App\Models\Upz;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AmilController extends Controller
{
    public function index()
    {
        $search = request('search');
        $amils = Amil::latest();
        if (request('search')) {
            $amils->where('nama', 'like', '%' . $search . '%')
                ->orWhere('alamat_rumah', 'like', '%' . $search . '%')
                ->orWhere('pekerjaan', 'like', '%' . $search . '%')
                ->orWhere('telepon', 'like', '%' . $search . '%');
        }

        $amils = $amils->paginate(10)->appends(['search' => $search]);

        return view('amil.index', compact('amils', 'search'));
    }

    public function create()
    {
        $users = User::all();
        $upzs = Upz::all();

        return view('amil.create', compact('upzs', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'upz_id' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_rumah' => 'required',
            'telepon' => 'required',
        ]);

        if ($request->nik) {
            $validatedData['nik'] = $request->nik;
        }
        if ($request->tempat_lahir) {
            $validatedData['tempat_lahir'] = $request->tempat_lahir;
        }
        if ($request->tanggal_lahir) {
            $validatedData['tanggal_lahir'] = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        }
        if ($request->pekerjaan) {
            $validatedData['pekerjaan'] = $request->pekerjaan;
        }
        if ($request->keterangan) {
            $validatedData['keterangan'] = $request->keterangan;
        }
        if ($request->alamat_kantor) {
            $validatedData['alamat_kantor'] = $request->alamat_kantor;
        }

        $unique = Amil::where('user_id', $request->user_id)->exists();

        if (!empty($unique)) {
            return redirect()->route('amil.create')->with(['error' => 'Data Sudah Ada!']);
        } else {
            Amil::create($validatedData);

            return redirect()->route('amil.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    }

    public function edit(string $id)
    {
        $users = User::all();
        $upzs = Upz::all();
        $amil = Amil::findOrFail($id);
        $tanggalFormatted = Carbon::parse($amil->tanggal_lahir)->format('d/m/Y');

        return view('amil.edit', compact('users', 'upzs', 'amil', 'tanggalFormatted'));
    }

    public function update(Request $request, string $id)
    {
        $amil = Amil::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required',
            'upz_id' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat_rumah' => 'required',
            'telepon' => 'required',
        ]);

        if ($request->nik) {
            $validatedData['nik'] = $request->nik;
        }
        if ($request->tempat_lahir) {
            $validatedData['tempat_lahir'] = $request->tempat_lahir;
        }
        if ($request->tanggal_lahir) {
            $validatedData['tanggal_lahir'] = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
        }
        if ($request->pekerjaan) {
            $validatedData['pekerjaan'] = $request->pekerjaan;
        }
        if ($request->keterangan) {
            $validatedData['keterangan'] = $request->keterangan;
        }
        if ($request->alamat_kantor) {
            $validatedData['alamat_kantor'] = $request->alamat_kantor;
        }

        if ($request->user_id != $amil->user_id) {
            $unique = Amil::where('user_id', $request->user_id)->exists();

            if (!empty($unique)) {
                return redirect()->route('amil.edit', $amil->id)->with(['error' => 'Akun Amil Telah Digunakan!']);
            } else {
                $amil->update($validatedData);

                return redirect()->route('amil.index')->with(['success' => 'Data Berhasil Diubah!']);
            }
        } else {
            $amil->update($validatedData);

            return redirect()->route('amil.index')->with(['success' => 'Data Berhasil Diubah!']);
        }
    }

    public function destroy(string $id)
    {
        $amil = Amil::findOrFail($id);
        $amil->delete();

        return redirect()->route('amil.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
