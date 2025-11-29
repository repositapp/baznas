<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran Zakat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
        }

        .kop img {
            width: 70px;
            float: left;
        }

        .kop h3,
        .kop h4 {
            margin: 0;
        }

        .kop h4 {
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .ttd {
            margin-top: 40px;
            width: 100%;
            text-align: right;
        }
    </style>
</head>

<body onload="window.print()">

    @php
        $setting = \App\Models\Aplikasi::first();
        $totalKeseluruhan = $data->sum('total');
    @endphp

    <div class="kop">
        @if ($setting && $setting->logo)
            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo">
        @endif
        <div style="margin-left: 80px;">
            <h3>{{ $setting->nama_lembaga ?? 'BAZNAS' }}</h3>
            <h4>{{ $setting->alamat ?? 'Alamat belum diatur' }}</h4>
            <h4>Telp.{{ $setting->telepon ?? '0000-0000' }}, Fax.{{ $setting->fax ?? '0000-0000' }},
                Email.{{ $setting->email ?? 'baznas@gmail.com' }}</h4>
        </div>
        <div style="clear: both;"></div>
    </div>

    <h3 style="text-align: center;">Laporan Pembayaran Zakat</h3>
    <p style="text-align: center; margin-block-start: -1em;">Periode: {{ date('d/m/Y', strtotime($request->tgl_awal)) }}
        s/d
        {{ date('d/m/Y', strtotime($request->tgl_akhir)) }}</p>

    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Muzaki</th>
                <th>Jenis Zakat</th>
                <th style="text-align: center; width: 80px;">Jumlah Keluarga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $item)
                <tr>
                    <td style="text-align: center;">{{ $key + 1 }}</td>
                    <td>{{ $item->kode_pembayaran }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->tgl_bayar)) }}</td>
                    <td>{{ $item->muzaki->nama ?? '-' }}</td>
                    <td>{{ $item->zakat->nama_sumbangan ?? '-' }}</td>
                    <td style="text-align: center;">{{ $item->jumlah_keluarga }}</td>
                    <td>
                        @if ($item->zakat->id == 1)
                            {{ $item->total }} Kg
                        @else
                            Rp. {{ number_format($item->total, 0, ',', '.') }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Data tidak tersedia.</td>
                </tr>
            @endforelse
            @if ($data->count() > 0)
                <tr>
                    <td colspan="6" style="text-align: right;"><strong>Total Keseluruhan:</strong></td>
                    <td>
                        @if ($request->zakat_id == 1)
                            <strong>{{ $totalKeseluruhan }} Kg</strong>
                        @else
                            <strong>Rp. {{ number_format($totalKeseluruhan, 0, ',', '.') }}</strong>
                        @endif
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="ttd">
        <p>Baubau, {{ date('d F Y', strtotime(now())) }}</p>
        <p>Pimpinan</p>
        <br><br><br>
        <strong><u>{{ $setting->nama_ketua ?? '......................' }}</u></strong>
    </div>

</body>

</html>
