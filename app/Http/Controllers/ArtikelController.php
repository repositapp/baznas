<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with(['author', 'kategori']);

        $search = request('search');
        if (request('search')) {
            $artikels->when($search, function ($query, $search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('kutipan', 'like', '%' . $search . '%')

                    // Relasi ke author
                    ->orWhereHas('author', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })

                    // Relasi ke kategori
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            })
                ->latest();
        }

        $artikels = $artikels->paginate(10)->appends(['search' => $search]);

        return view('artikel.index', compact('artikels', 'search'));
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('artikel.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required|max:255',
            'body' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',
        ]);

        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $fileName = Str::slug($validatedData['judul']) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('artikel-images', $fileName);
            $validatedData['gambar'] = 'artikel-images/' . $fileName;
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['slug'] = Str::slug($validatedData['judul']);
        $validatedData['kutipan'] = Str::limit(strip_tags($request->body), 200);

        Artikel::create($validatedData);

        return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        $kategoris = Kategori::all();

        return view('artikel.edit', compact('artikel', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $artikel = Artikel::findOrFail($id);

        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required|max:255',
            'body' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',
        ]);

        if ($request->file('gambar')) {
            if ($artikel->gambar != null) {
                Storage::delete($artikel->gambar);
            }
            $file = $request->file('gambar');
            $fileName = Str::slug($validatedData['judul']) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('artikel-images', $fileName);
            $validatedData['gambar'] = 'artikel-images/' . $fileName;
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['slug'] = Str::slug($validatedData['judul']);
        $validatedData['kutipan'] = Str::limit(strip_tags($request->body), 200);

        $artikel->update($validatedData);

        return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        if ($artikel->gambar) {
            Storage::delete($artikel->gambar);
        }
        $artikel->delete();

        return redirect()->route('artikel.index')->with(['success' => 'Data berhasil dihapus!']);
    }

    public function kategori(Request $request, $slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $search = $request->search;

        $artikels = Artikel::where('kategori_id', $kategori->id)
            ->when($search, function ($query, $search) {
                $query->where('judul', 'like', "%$search%")
                    ->orWhere('kutipan', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('artikel.kategori', compact('kategori', 'artikels', 'search'));
    }


    public function show($slug)
    {
        $artikel = Artikel::with('kategori', 'author')->where('slug', $slug)->firstOrFail();
        $artikels = Artikel::latest()->take(10)
            ->where('status', 1)
            ->get();

        // Tambahkan +1 setiap kali dibuka
        $artikel->increment('views');

        return view('artikel.show', compact('artikel', 'artikels'));
    }
}
