<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategoriupz;
use App\Models\Upz;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UpzController extends Controller
{
    public function index()
    {
        $search = request('search');
        $upzs = Upz::latest();
        if (request('search')) {
            $upzs->where('nama_upz', 'like', '%' . $search . '%')
                ->orWhere('npwp', 'like', '%' . $search . '%')
                ->orWhere('no_pengukuhan', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%');
        }

        $upzs = $upzs->paginate(10)->appends(['search' => $search]);

        return view('upz.index', compact('upzs', 'search'));
    }

    public function create()
    {
        $kategoris = Kategoriupz::all();

        return view('upz.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategoriupz_id' => 'required',
            'nama_upz' => 'required',
            'no_pengukuhan' => 'required',
            'tgl_pengukuhan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'fax' => 'required',
            'email' => 'required|email:dns',
        ]);

        $validatedData['tgl_pengukuhan'] = Carbon::parse($request->tgl_pengukuhan)->format('Y-m-d');

        if ($request->npwp) {
            $validatedData['npwp'] = $request->npwp;
        }

        Upz::create($validatedData);

        return redirect()->route('upz.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $kategoris = Kategoriupz::all();
        $upz = Upz::findOrFail($id);
        $tanggalFormatted = Carbon::parse($upz->tgl_pengukuhan)->format('m/d/Y');

        return view('upz.edit', compact('upz', 'kategoris', 'tanggalFormatted'));
    }

    public function update(Request $request, string $id)
    {
        $upz = Upz::findOrFail($id);

        $validatedData = $request->validate([
            'kategoriupz_id' => 'required',
            'nama_upz' => 'required',
            'no_pengukuhan' => 'required',
            'tgl_pengukuhan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'fax' => 'required',
            'email' => 'required|email:dns',
        ]);

        $tanggal = Carbon::parse($request->tgl_pengukuhan)->format('Y-m-d');
        $validatedData['tgl_pengukuhan'] = $tanggal;

        if ($request->npwp) {
            $validatedData['npwp'] = $request->npwp;
        }

        $upz->update($validatedData);
        return redirect()->route('upz.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $upz = Upz::findOrFail($id);
        $upz->delete();

        return redirect()->route('upz.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show()
    {
        $search = request('search');
        $query = Upz::latest();
        if (request('search')) {
            $query->where('nama_upz', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('telepon', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        $upzs = $query->paginate(10)->appends(['search' => $search]);

        return view('upz.show', compact('upzs', 'search'));
    }
}
