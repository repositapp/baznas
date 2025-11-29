@extends('layouts.master')
@section('title')
    Data Penyaluran
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Penyaluran
        @endslot
        @slot('li_2')
            Data Penyaluran
        @endslot
        @slot('title')
            Data Penyaluran
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        <form action="{{ route('penyaluran.index') }}">
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
                        <a href="{{ route('penyaluran.create') }}" class="btn btn-social btn-sm btn-success">
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
                            <th>Mustahik</th>
                            <th>Jumlah Keluarga</th>
                            <th>Jenis Zakat</th>
                            <th>Metode Bayar</th>
                            <th>Total Bayar</th>
                            <th class="text-center" style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <Tbody>
                        @forelse ($penyalurans as $penyaluran)
                            <tr>
                                <td class="text-center">{{ $penyalurans->firstItem() + $loop->index }}</td>
                                @if (Auth::user()->role != 'petugas_upz')
                                    <td>{{ $penyaluran->upz->nama_upz }}</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($penyaluran->tgl_penyaluran)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ $penyaluran->mustahik->nama }}</td>
                                <td>{{ $penyaluran->mustahik->anggota_keluarga }}</td>
                                <td>{{ $penyaluran->zakat->nama_sumbangan }}</td>
                                <td>{{ $penyaluran->zakat->jenis_benda }}</td>
                                <td>{{ $penyaluran->total }}</td>
                                <td class="text-center">
                                    <div class="btn-group d-flex">
                                        <a href="{{ route('penyaluran.edit', $penyaluran->id) }}"
                                            class="btn btn-default btn-sm text-green"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('penyaluran.destroy', $penyaluran->id) }}" method="POST"
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
                                <td colspan="@if (Auth::user()->role == 'petugas_upz') 8
                                @else
                                    9 @endif"
                                    class="text-center">
                                    Data Penyaluran Zakat belum Tersedia.
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
                        {{ $penyalurans->firstItem() }}
                        hingga
                        {{ $penyalurans->lastItem() }}
                        dari
                        {{ $penyalurans->total() }} entri
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $penyalurans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
