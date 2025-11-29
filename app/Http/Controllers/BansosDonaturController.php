<?php

namespace App\Http\Controllers;

use App\Models\Akunbank;
use App\Models\Bansos;
use App\Models\Bansosdonatur;
use Illuminate\Http\Request;

class BansosDonaturController extends Controller
{
    public function donaturCreate($slug)
    {
        $bansos = Bansos::where('slug', $slug)->firstOrFail();
        $akunbanks = Akunbank::all();
        return view('bansos.donatur.create', compact('bansos', 'akunbanks'));
    }

    public function donaturStore(Request $request)
    {
        $validatedData = $request->validate([
            'bansos_id' => 'required|exists:bansos,id',
            'akunbank_id' => 'required|exists:akunbanks,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required',
            'nominal_donasi' => 'required|numeric|min:10000',
            'komentar' => 'nullable|string',
            'anonim' => 'nullable|boolean'
        ]);


        $validatedData['nama'] = $request->anonim ? 'Anonim' : $request->nama;
        $validatedData['status'] = false;

        $donasi = Bansosdonatur::create($validatedData);

        return redirect()->route('donatur.upload', $donasi->id)
            ->with('success', 'Donasi berhasil dibuat. Silakan upload bukti transfer.');
    }

    public function uploadBukti($id)
    {
        $donasi = BansosDonatur::findOrFail($id);
        return view('bansos.donatur.upload', compact('donasi'));
    }

    public function storeBukti(Request $request, $id)
    {
        $donatur = BansosDonatur::findOrFail($id);

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('bukti-transfer');
        }

        $donatur->update($validatedData);

        return redirect()->route('donatur.invoice', $donatur->id)
            ->with('success', 'Bukti transfer berhasil diupload.');
    }

    public function invoice($id)
    {
        $donasi = BansosDonatur::with('bansos', 'akunbank')->findOrFail($id);
        return view('bansos.donatur.invoice', compact('donasi'));
    }
}
