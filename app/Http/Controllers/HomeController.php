<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Bansos;
use App\Models\Bansosdonatur;
use App\Models\Bansossaluran;
use App\Models\Mustahik;
use App\Models\Muzaki;
use App\Models\Pembayaran;
use App\Models\Penyaluran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Data Program Bansos aktif
        $programs = Bansos::with('amil', 'donaturs')->where('status', true)->latest()->take(3)->get();

        // Artikel & Cerita Aksi berdasarkan kategori
        $artikels = Artikel::whereHas('kategori', function ($q) {
            $q->where('id', 1);
        })->latest()->take(3)->get();

        $ceritas = Artikel::whereHas('kategori', function ($q) {
            $q->where('id', 2);
        })->latest()->take(3)->get();

        // Statistik
        $jumlah_muzaki = Muzaki::count();
        $jumlah_mustahik = Mustahik::count();

        // Dana Terkumpul dari pembayaran zakat & donatur bansos
        $dana_pembayaran = Pembayaran::whereNotIn('zakat_id', [1, 2])->sum('total');
        $dana_donatur = Bansosdonatur::sum('nominal_donasi');
        $dana_terkumpul = $dana_pembayaran + $dana_donatur;

        // Dana Tersalurkan
        $penyaluran_uang = Penyaluran::whereNotIn('zakat_id', [1, 2])->sum('total');

        $bansos_salur = Bansossaluran::sum('total_nominal');
        $dana_tersalurkan = $penyaluran_uang + $bansos_salur;

        // Jumlah orang terbantu
        $orang_terbantu_zakat = Penyaluran::distinct('mustahik_id')->count('mustahik_id');
        $orang_terbantu_bansos = Bansossaluran::sum('jumlah_penerima');
        $total_terbantu = $orang_terbantu_zakat + $orang_terbantu_bansos;

        // Total beras tersalurkan berdasarkan zakat_id = 1
        $beras_tersalurkan = Penyaluran::where('zakat_id', 1)->sum('total');

        return view('beranda.index', compact(
            'programs',
            'artikels',
            'ceritas',
            'jumlah_muzaki',
            'jumlah_mustahik',
            'dana_terkumpul',
            'dana_tersalurkan',
            'total_terbantu',
            'beras_tersalurkan'
        ));
    }
}
