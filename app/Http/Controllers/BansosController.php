<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bansos;
use App\Models\Bansosdonatur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BansosController extends Controller
{
    public function index()
    {
        $search = request('search');

        $programs = Bansos::with('donaturs')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('range_start', 'like', '%' . $search . '%')
                    ->orWhere('range_end', 'like', '%' . $search . '%');
            })
            ->paginate(10)
            ->withQueryString(); // agar pagination tetap menyertakan parameter pencarian

        // Hitung informasi tambahan
        $programs->getCollection()->transform(function ($program) {
            $durasi = Carbon::parse($program->range_start)->diffInDays(Carbon::parse($program->range_end)) + 1;
            $jumlahDonatur = $program->donaturs->count();
            $jumlahDana = $program->donaturs->sum(function ($donatur) {
                return (int) str_replace('.', '', $donatur->nominal_donasi);
            });
            $persen = $program->jumlah_donasi > 0 ? ($jumlahDana / $program->jumlah_donasi) * 100 : 0;

            $program->durasi = $durasi;
            $program->jumlahDonatur = $jumlahDonatur;
            $program->jumlahDana = $jumlahDana;
            $program->persen = round($persen, 2);
            return $program;
        });


        return view('bansos.program.index', compact('programs', 'search'));
    }

    public function daftarDonatur($id)
    {
        $program = Bansos::findOrFail($id);
        $donaturs = Bansosdonatur::where('bansos_id', $id)
            ->latest()
            ->paginate(5);

        return view('bansos.program.donatur', compact('donaturs', 'program'));
    }

    public function create()
    {
        return view('bansos.program.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'range_start' => 'required',
            'range_end' => 'required',
            'jumlah_donasi' => 'required',
            'image' => 'required|image|file|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = Str::slug($validatedData['title']) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('bansos-images', $fileName);
            $validatedData['image'] = 'bansos-images/' . $fileName;
        }

        $validatedData['upz_id'] = session('upz_id');
        $validatedData['amil_id'] = session('amil_id');
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['range_start'] = Carbon::parse($request->range_start)->format('Y-m-d');
        $validatedData['range_end'] = Carbon::parse($request->range_end)->format('Y-m-d');

        Bansos::create($validatedData);

        return redirect()->route('program.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $program = Bansos::findOrFail($id);
        $datestartFormatted = Carbon::parse($program->range_start)->format('m/d/Y');
        $dateendFormatted = Carbon::parse($program->range_end)->format('m/d/Y');

        return view('bansos.program.edit', compact('program', 'datestartFormatted', 'dateendFormatted'));
    }

    public function update(Request $request, string $id)
    {
        $program = Bansos::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'range_start' => 'required|date_format:m/d/Y',
            'range_end' => 'required|date_format:m/d/Y',
            'jumlah_donasi' => 'required',
            'image' => 'image|file|mimes:png,jpg,jpeg,webp|max:2048',
            'status' => 'required',
        ]);

        if ($request->file('image')) {
            if ($program->image != null) {
                Storage::delete($program->image);
            }
            $file = $request->file('image');
            $fileName = Str::slug($validatedData['title']) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('bansos-images', $fileName);
            $validatedData['image'] = 'bansos-images/' . $fileName;
        }

        $validatedData['upz_id'] = session('upz_id');
        $validatedData['amil_id'] = session('amil_id');
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['range_start'] = Carbon::createFromFormat('m/d/Y', $request->range_start)->format('Y-m-d');
        $validatedData['range_end'] = Carbon::createFromFormat('m/d/Y', $request->range_end)->format('Y-m-d');

        $program->update($validatedData);

        return redirect()->route('program.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $program = Bansos::findOrFail($id);

        if ($program->image) {
            Storage::delete($program->image);
        }

        $program->delete();

        return redirect()->route('program.index')->with(['success' => 'Data berhasil dihapus!']);
    }

    public function show($slug)
    {
        $program = Bansos::with('amil', 'donaturs')->where('slug', $slug)->firstOrFail();

        // Tambahkan +1 setiap kali dibuka
        if (!session()->has('viewed_programs_' . $program->id)) {
            $program->increment('views');
            session(['viewed_programs_' . $program->id => true]);
        }

        return view('bansos.program.show', compact('program'));
    }
}
