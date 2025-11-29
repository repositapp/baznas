<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Akunbank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BankController extends Controller
{
    public function index()
    {
        $search = request('search');
        $banks = Akunbank::latest();
        if (request('search')) {
            $banks->where('nama_bank', 'like', '%' . $search . '%')
                ->orWhere('rekening', 'like', '%' . $search . '%')
                ->orWhere('pemilik', 'like', '%' . $search . '%');
        }

        $banks = $banks->paginate(10)->appends(['search' => $search]);

        return view('pengaturan.bank.index', compact('banks', 'search'));
    }

    public function create()
    {
        return view('pengaturan.bank.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_bank' => 'required',
            'rekening' => 'required',
            'pemilik' => 'required',
            'logo_bank' => 'nullable|image|file|mimes:png,jpg,jpeg,webp|max:1024',
        ]);

        if ($request->file('logo_bank')) {
            $file = $request->file('logo_bank');
            $fileName = Str::slug($validatedData['nama_bank']) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('bank-logos', $fileName);
            $validatedData['logo_bank'] = 'bank-logos/' . $fileName;
        }

        Akunbank::create($validatedData);

        return redirect()->route('bank.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $bank = Akunbank::findOrFail($id);

        return view('pengaturan.bank.edit', compact('bank'));
    }

    public function update(Request $request, string $id)
    {;
        $bank = Akunbank::findOrFail($id);

        $validatedData = $request->validate([
            'nama_bank' => 'required',
            'rekening' => 'required',
            'pemilik' => 'required',
            'logo_bank' => 'nullable|image|file|mimes:png,jpg,jpeg,webp|max:1024',
        ]);

        if ($request->file('logo_bank')) {
            if ($bank->logo_bank != null) {
                Storage::delete($bank->logo_bank);
            }
            $file = $request->file('logo_bank');
            $fileName = Str::slug($validatedData['nama_bank']) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('bank-logos', $fileName);
            $validatedData['logo_bank'] = 'bank-logos/' . $fileName;
        }

        $bank->update($validatedData);

        return redirect()->route('bank.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $bank = Akunbank::findOrFail($id);
        if ($bank->logo_bank) {
            Storage::delete($bank->logo_bank);
        }
        $bank->delete();

        return redirect()->route('bank.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show()
    {
        $search = request('search');
        $query = Akunbank::latest();
        if (request('search')) {
            $query->where('nama_bank', 'like', '%' . $search . '%')
                ->orWhere('rekening', 'like', '%' . $search . '%')
                ->orWhere('pemilik', 'like', '%' . $search . '%');
        }

        $banks = $query->paginate(10)->appends(['search' => $search]);

        return view('pengaturan.bank.show', compact('banks', 'search'));
    }
}
