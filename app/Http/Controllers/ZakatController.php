<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use Illuminate\Http\Request;

class ZakatController extends Controller
{
    public function index()
    {
        $search = request('search');
        $zakats = Zakat::latest();
        if (request('search')) {
            $zakats->where('nama_sumbangan', 'like', '%' . $search . '%')
                ->orWhere('jenis_benda', 'like', '%' . $search . '%')
                ->orWhere('nilai_ukuran', 'like', '%' . $search . '%');
        }

        $zakats = $zakats->paginate(10)->appends(['search' => $search]);

        return view('pengaturan.zakat.index', compact('zakats', 'search'));
    }

    public function create()
    {
        return view('pengaturan.zakat.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_sumbangan' => 'required',
            'jenis_benda' => 'required',
            'nilai_ukuran' => 'required',
        ]);

        Zakat::create($validatedData);

        return redirect()->route('zakat.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $zakat = Zakat::findOrFail($id);

        return view('pengaturan.zakat.edit', compact('zakat'));
    }

    public function update(Request $request, string $id)
    {
        $zakat = Zakat::findOrFail($id);

        $validatedData = $request->validate([
            'nama_sumbangan' => 'required',
            'jenis_benda' => 'required',
            'nilai_ukuran' => 'required',
        ]);

        $zakat->update($validatedData);

        return redirect()->route('zakat.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $zakat = Zakat::findOrFail($id);
        $zakat->delete();

        return redirect()->route('zakat.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
