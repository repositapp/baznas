<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Golongan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GolonganController extends Controller
{
    public function index()
    {
        $search = request('search');
        $golongans = Golongan::latest();
        if (request('search')) {
            $golongans->where('name', 'like', '%' . $search . '%');
        }

        $golongans = $golongans->paginate(10)->appends(['search' => $search]);

        return view('pengaturan.golongan.index', compact('golongans', 'search'));
    }

    public function create()
    {
        return view('pengaturan.golongan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $unique = Golongan::where('name', $request->name)->exists();

        if (!empty($unique)) {
            return redirect()->route('golongan_mustahik.create')->with(['error' => 'Data Sudah Ada!']);
        } else {
            Golongan::create($validatedData);

            return redirect()->route('golongan_mustahik.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    }

    public function edit(string $id)
    {
        $golongan = Golongan::findOrFail($id);

        return view('pengaturan.golongan.edit', compact('golongan'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:255'
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $unique = Golongan::where('name', $request->name)->exists();

        if (!empty($unique)) {
            return redirect()->route('golongan_mustahik.edit', $id)->with(['error' => 'Data Sudah Ada!']);
        } else {
            $golongan = Golongan::findOrFail($id);

            $golongan->update($validatedData);

            return redirect()->route('golongan_mustahik.index')->with(['success' => 'Data Berhasil Diubah!']);
        }
    }

    public function destroy(string $id)
    {
        $golongan = Golongan::findOrFail($id);
        $golongan->delete();

        return redirect()->route('golongan_mustahik.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
