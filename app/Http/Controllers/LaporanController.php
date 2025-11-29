<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    public function index()
    {
        $search = request('search');
        $laporans = Laporan::latest();
        if (request('search')) {
            $laporans->where('nama_dokumen', 'like', '%' . $search . '%')
                ->orWhere('ekstensi', 'like', '%' . $search . '%')
                ->orWhere('ukuran', 'like', '%' . $search . '%')
                ->orWhere('download', 'like', '%' . $search . '%');
        }

        $laporans = $laporans->paginate(10)->appends(['search' => $search]);

        return view('laporan.index', compact('laporans', 'search'));
    }

    public function download($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!$laporan->dokumen || !Storage::exists($laporan->dokumen)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Tambahkan jumlah unduhan (+1) setiap kali file diunduh
        $laporan->increment('download');

        return Storage::download($laporan->dokumen, $laporan->name);
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dokumen' => 'required',
            'dokumen' => 'nullable|file|max:10240',
        ]);

        if ($request->file('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = Str::slug($validatedData['nama_dokumen']) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('dokumen-file', $fileName);
            $validatedData['dokumen'] = 'dokumen-file/' . $fileName;
            $validatedData['ekstensi'] = $file->getClientOriginalExtension();
            $validatedData['ukuran'] = round($file->getSize() / 1024, 2);
        }

        Laporan::create($validatedData);

        return redirect()->route('laporan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $laporan = Laporan::findOrFail($id);

        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, string $id)
    {;
        $laporan = Laporan::findOrFail($id);

        $validatedData = $request->validate([
            'nama_dokumen' => 'required',
            'dokumen' => 'nullable|file|max:10240',
        ]);

        if ($request->file('dokumen')) {
            if ($laporan->dokumen != null) {
                Storage::delete($laporan->dokumen);
            }
            $file = $request->file('dokumen');
            $fileName = Str::slug($validatedData['nama_dokumen']) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('dokumen-file', $fileName);
            $validatedData['dokumen'] = 'dokumen-file/' . $fileName;
            $validatedData['ekstensi'] = $file->getClientOriginalExtension();
            $validatedData['ukuran'] = round($file->getSize() / 1024, 2);
        }

        $laporan->update($validatedData);

        return redirect()->route('laporan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->dokumen) {
            Storage::delete($laporan->dokumen);
        }
        $laporan->delete();

        return redirect()->route('laporan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show()
    {
        $search = request('search');
        $laporans = Laporan::latest();
        if (request('search')) {
            $laporans->where('nama_dokumen', 'like', '%' . $search . '%')
                ->orWhere('ekstensi', 'like', '%' . $search . '%')
                ->orWhere('ukuran', 'like', '%' . $search . '%')
                ->orWhere('download', 'like', '%' . $search . '%');
        }

        $laporans = $laporans->paginate(10)->appends(['search' => $search]);

        return view('laporan.show', compact('laporans', 'search'));
    }
}
