<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Amil;
use App\Models\Bansosdonatur;
use App\Models\Bansossaluran;
use App\Models\Mustahik;
use App\Models\Muzaki;
use App\Models\Pembayaran;
use App\Models\Penyaluran;
use App\Models\Upz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $role = $user->role;

        $upz_id = session('upz_id');

        $data = [];

        // Jika admin atau petugas baznas, ambil semua data
        if ($role === 'admin' || $role === 'petugas_baznas') {
            $data['total_kas'] = (Pembayaran::whereNotIn('zakat_id', [1, 2])->sum('total') - Penyaluran::whereNotIn('zakat_id', [1, 2])->sum('total')) + (Bansosdonatur::sum('nominal_donasi') - Bansossaluran::sum('total_nominal'));
            $data['total_pemasukan'] = Pembayaran::whereNotIn('zakat_id', [1, 2])->sum('total') + Bansosdonatur::sum('nominal_donasi');
            $data['total_pengeluaran'] = Bansossaluran::sum('total_nominal') - Penyaluran::whereNotIn('zakat_id', [1, 2])->sum('total');
            $data['total_muzaki'] = Muzaki::count();
            $data['total_mustahik'] = Mustahik::count();
            $data['total_upz'] = Upz::count();
            $data['total_petugas'] = Amil::count();
        } elseif ($role === 'petugas_upz') {
            $data['total_kas'] = Pembayaran::where('upz_id', $upz_id)->whereNotIn('zakat_id', [1, 2])->sum('total') -
                Penyaluran::where('upz_id', $upz_id)->whereNotIn('zakat_id', [1, 2])->sum('total');
            $data['total_pemasukan'] = Pembayaran::where('upz_id', $upz_id)->whereNotIn('zakat_id', [1, 2])->sum('total');
            $data['total_pengeluaran'] = Penyaluran::where('upz_id', $upz_id)->whereNotIn('zakat_id', [1, 2])->sum('total');
            $data['total_muzaki'] = Muzaki::where('upz_id', $upz_id)->count();
            $data['total_mustahik'] = Mustahik::where('upz_id', $upz_id)->count();
            $data['total_upz'] = null; // tidak ditampilkan
            $data['total_petugas'] = Amil::where('upz_id', $upz_id)->count();
        }

        return view('dashboard.index', compact('data', 'role'));
    }
}
