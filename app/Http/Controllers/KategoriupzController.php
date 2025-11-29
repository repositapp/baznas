<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategoriupz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriupzController extends Controller
{
    public function index()
    {
        $search = request('search');
        $kategoris = Kategoriupz::latest();
        if (request('search')) {
            $kategoris->where('name', 'like', '%' . $search . '%');
        }

        $kategoris = $kategoris->paginate(10)->appends(['search' => $search]);

        return view('pengaturan.kategori.index', compact('kategoris', 'search'));
    }

    public function create()
    {
        return view('pengaturan.kategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $unique = Kategoriupz::where('name', $request->name)->exists();

        if (!empty($unique)) {
            return redirect()->route('kategori_upz.create')->with(['error' => 'Data Sudah Ada!']);
        } else {
            Kategoriupz::create($validatedData);

            return redirect()->route('kategori_upz.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
    }

    public function edit(string $id)
    {
        $kategori = Kategoriupz::findOrFail($id);

        return view('pengaturan.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:255'
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $unique = Kategoriupz::where('name', $request->name)->exists();

        if (!empty($unique)) {
            return redirect()->route('kategori_upz.edit', $id)->with(['error' => 'Data Sudah Ada!']);
        } else {
            $kategori = Kategoriupz::findOrFail($id);

            $kategori->update($validatedData);

            return redirect()->route('kategori_upz.index')->with(['success' => 'Data Berhasil Diubah!']);
        }
    }

    public function destroy(string $id)
    {
        $kategori = Kategoriupz::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori_upz.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
