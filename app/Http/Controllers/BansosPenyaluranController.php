<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\Bansossaluran;
use Illuminate\Http\Request;

class BansosPenyaluranController extends Controller
{
    public function index()
    {
        $penyalurans = Bansossaluran::with(['bansos']);

        $search = request('search');
        if (request('search')) {
            $penyalurans->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')

                    // Relasi ke bansos
                    ->orWhereHas('bansos', function ($q) use ($search) {
                        $q->where('title', 'like', '%' . $search . '%')
                            ->orWhere('anggota_keluarga', 'like', '%' . $search . '%');
                    });
            })
                ->latest();
        }

        $penyalurans = $penyalurans->paginate(10)->appends(['search' => $search]);

        return view('bansos.penyaluran.index', compact('penyalurans', 'search'));
    }

    public function create()
    {
        $programs = Bansos::whereNotIn('status', [2])->get();

        return view('bansos.penyaluran.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bansos_id' => 'required',
            'title' => 'required',
            'jumlah_penerima' => 'required',
            'total_nominal' => 'required',
            'body' => 'required',
        ]);

        Bansossaluran::create($validatedData);

        return redirect()->route('bansos-penyaluran.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $penyaluran = Bansossaluran::findOrFail($id);
        $programs = Bansos::whereNotIn('status', [2])->get();

        return view('bansos.penyaluran.edit', compact('penyaluran', 'programs'));
    }

    public function update(Request $request, string $id)
    {
        $penyaluran = Bansossaluran::findOrFail($id);

        $validatedData = $request->validate([
            'bansos_id' => 'required',
            'title' => 'required',
            'jumlah_penerima' => 'required',
            'total_nominal' => 'required',
            'body' => 'required',
        ]);

        $penyaluran->update($validatedData);

        return redirect()->route('bansos-penyaluran.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $penyaluran = Bansossaluran::findOrFail($id);
        $penyaluran->delete();

        return redirect()->route('bansos-penyaluran.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}
