<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Akunbank;
use App\Models\Artikel;
use App\Models\Bansos;
use App\Models\Halaman;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\Menu;
use App\Models\Upz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::with(['children', 'parent']);

        $search = $request->search;

        $menus->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                // relasi ke parent menu
                ->orWhereHas('parent', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        })->latest();

        $menus = $menus->paginate(10)->appends(['search' => $search]);

        return view('modul.menu.index', compact('menus'));
    }

    public function create()
    {
        $menus = Menu::whereNull('parent_id')->get();
        return view('modul.menu.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'target_id' => 'nullable',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Menu::create($validatedData);

        return redirect()->route('menu.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Menu $menu)
    {
        $menus = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->get();
        return view('modul.menu.edit', compact('menu', 'menus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'target_id' => 'nullable',
            'parent_id' => 'nullable',
            'order' => 'nullable|integer|exists:menus,id',
            'status' => 'required|boolean',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        $menu->update($validatedData);

        return redirect()->route('menu.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')->with(['success' => 'Data berhasil dihapus!']);
    }

    // AJAX: Ambil data berdasarkan tipe
    public function loadTargets(Request $request)
    {
        $type = $request->query('type');
        $data = match ($type) {
            'halaman' => Halaman::select('id', 'judul as name')->get(),
            'artikel' => Artikel::select('id', 'judul as name')->get(),
            default => collect()
        };

        return response()->json($data);

        $type = $request->query('type');

        switch ($type) {
            case 'halaman':
                $targets = Halaman::select('id', 'title as name')->get();
                break;
            case 'artikel':
                $targets = Artikel::select('id', 'judul as name')->get();
                break;
            case 'program':
                $targets = Bansos::select('id', 'judul as name')->get();
                break;
            default:
                $targets = [];
        }

        return response()->json($targets);
    }

    public function show(Request $request, $slug)
    {
        $menu = Menu::where('slug', $slug)->firstOrFail();

        $search = $request->search;
        $kategori_id = $request->kategori;

        switch ($menu->type) {
            case 'artikel':
                $query = Artikel::with('kategori')->where('status', true);

                if ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('judul', 'like', "%$search%")
                            ->orWhere('kutipan', 'like', "%$search%");
                    });
                }

                if ($kategori_id) {
                    $query->where('kategori_id', $kategori_id);
                }

                $artikels = $query->latest()->paginate(12)->appends($request->only(['search', 'kategori']));
                $kategoris = Kategori::all();

                return view('artikel.list', compact('artikels', 'menu', 'search', 'kategoris', 'kategori_id'));

            case 'program':
                $query = Bansos::with('amil', 'donaturs')->where('status', true);

                if ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%$search%");
                    });
                }

                $programs = $query->latest()->paginate(12)->appends($request->only(['search']));

                return view('bansos.program.list', compact('programs', 'menu', 'search'));

            case 'rekening':
                $search = request('search');
                $query = Akunbank::latest();
                if (request('search')) {
                    $query->where('nama_bank', 'like', '%' . $search . '%')
                        ->orWhere('rekening', 'like', '%' . $search . '%')
                        ->orWhere('pemilik', 'like', '%' . $search . '%');
                }

                $banks = $query->paginate(10)->appends(['search' => $search]);

                return view('pengaturan.bank.show', compact('banks', 'search'));

            case 'upz':
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

            case 'kalkulator':
                return view('pengaturan.bank.kalkulator');

            case 'halaman':
            default:
                $halaman = Halaman::findOrFail($menu->target_id);
                return view('modul.halaman.show', compact('halaman', 'menu'));
        }
    }
}
