<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penyaluran;
use App\Models\Upz;
use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    public function pembayaranIndex()
    {
        // Tampilkan Hanya diujung kata
        // $zakat = Zakat::all()->mapWithKeys(function ($item) {
        //     return [
        //         $item->id => $item->nama . ' - ' . $item->jenis_benda
        //     ];
        // });
        $zakats = Zakat::all();
        $user = auth()->user();

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas_baznas') {
            $upz = Upz::pluck('nama_upz', 'id');
        } else {
            $upz = Upz::where('id', $user->upz_id)->pluck('nama_upz', 'id');
        }

        return view('pelaporan.pembayaran.index', compact('zakats', 'upz'));
    }

    public function getPembayaranData(Request $request)
    {
        $user = auth()->user();

        $query = Pembayaran::with(['muzaki', 'zakat', 'upz'])
            ->whereBetween('tgl_bayar', [$request->tgl_awal, $request->tgl_akhir]);

        if ($request->zakat_id) {
            $query->where('zakat_id', $request->zakat_id);
        }

        if (Auth::user()->role == 'petugas_upz') {
            $query->where('upz_id', $user->upz_id);
        } else {
            if ($request->upz_id) {
                $query->where('upz_id', $request->upz_id);
            }
        }

        return response()->json($query->paginate(10));
    }

    public function cetakPembayaran(Request $request)
    {
        $user = auth()->user();
        if ($request->zakat_id) {
            $query = Pembayaran::with(['muzaki', 'zakat', 'upz'])
                ->whereBetween('tgl_bayar', [$request->tgl_awal, $request->tgl_akhir])
                ->where('zakat_id', $request->zakat_id);
        } else {
            $query = Pembayaran::with(['muzaki', 'zakat', 'upz'])
                ->whereBetween('tgl_bayar', [$request->tgl_awal, $request->tgl_akhir]);
        }

        // Filter berdasarkan peran user
        if (Auth::user()->role == 'petugas_upz') {
            $query->where('upz_id', $user->amil->upz_id);
        }

        $data = $query->get();

        return view('pelaporan.pembayaran.cetak', compact('data', 'request'));
    }

    public function penyaluran()
    {
        $zakats = Zakat::all();
        $user = auth()->user();

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas_baznas') {
            $upz = Upz::pluck('nama_upz', 'id');
        } else {
            $upz = Upz::where('id', $user->upz_id)->pluck('nama_upz', 'id');
        }

        return view('pelaporan.penyaluran.index', compact('zakats', 'upz'));
    }

    public function penyaluranData(Request $request)
    {
        $query = Penyaluran::with(['mustahik', 'zakat'])
            ->whereBetween('tgl_penyaluran', [$request->tgl_awal, $request->tgl_akhir]);

        if ($request->zakat_id) {
            $query->where('zakat_id', $request->zakat_id);
        }

        $data = $query->paginate(10);

        return response()->json($data);
    }

    public function cetakPenyaluran(Request $request)
    {
        $user = auth()->user();
        if ($request->zakat_id) {
            $query = Penyaluran::with(['mustahik', 'zakat'])
                ->whereBetween('tgl_penyaluran', [$request->tgl_awal, $request->tgl_akhir])
                ->where('zakat_id', $request->zakat_id);
        } else {
            $query = Penyaluran::with(['mustahik', 'zakat'])
                ->whereBetween('tgl_penyaluran', [$request->tgl_awal, $request->tgl_akhir]);
        }

        // Filter berdasarkan peran user
        if (Auth::user()->role == 'petugas_upz') {
            $query->where('upz_id', $user->amil->upz_id);
        }

        $data = $query->get();

        return view('pelaporan.penyaluran.cetak', compact('data', 'request'));
    }
}
