@extends('layouts.master')
@section('title')
    Data Pembayaran
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pembayaran
        @endslot
        @slot('li_2')
            Data Pembayaran
        @endslot
        @slot('title')
            Data Pembayaran
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        <form action="{{ route('pembayaran.index') }}">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <input type="text" name="search" class="form-control pull-right" placeholder="Search..."
                                    value="{{ request('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('pembayaran.create') }}" class="btn btn-social btn-sm btn-success">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px">No.</th>
                            @if (Auth::user()->role != 'petugas_upz')
                                <th>Upz</th>
                            @endif
                            <th>Tanggal</th>
                            <th>Nama Muzaki</th>
                            <th>Jenis Pembayaran</th>
                            <th>Metode Bayar</th>
                            <th>Nilai/Ukuran</th>
                            <th>Keluarga</th>
                            <th>Total Bayar</th>
                            <th class="text-center" style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <Tbody>
                        @forelse ($pembayarans as $pembayaran)
                            <tr>
                                <td class="text-center">{{ $pembayarans->firstItem() + $loop->index }}</td>
                                @if (Auth::user()->role != 'petugas_upz')
                                    <td>{{ $pembayaran->upz->nama_upz }}</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ $pembayaran->muzaki->nama }}</td>
                                <td>{{ $pembayaran->jenis_pembayaran }}</td>
                                <td>{{ $pembayaran->metode_bayar }}</td>
                                <td>{{ $pembayaran->nilai_ukur }}</td>
                                <td>{{ $pembayaran->jumlah_keluarga }}</td>
                                <td>{{ $pembayaran->total }}</td>
                                <td class="text-center">
                                    <div class="btn-group d-flex">
                                        <a href="{{ route('pembayaran.edit', $pembayaran->id) }}"
                                            class="btn btn-default btn-sm text-green"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-default btn-sm text-red"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="@if (Auth::user()->role == 'petugas_upz') 9
                                @else
                                    10 @endif"
                                    class="text-center">
                                    Data Pembayaran Zakat belum Tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </Tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        Menampilkan
                        {{ $pembayarans->firstItem() }}
                        hingga
                        {{ $pembayarans->lastItem() }}
                        dari
                        {{ $pembayarans->total() }} entri
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $pembayarans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
