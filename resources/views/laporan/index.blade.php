@extends('layouts.master')
@section('title')
    Laporan
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Master Data
        @endslot
        @slot('li_2')
            Laporan
        @endslot
        @slot('title')
            Laporan
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        <form action="{{ route('laporan.index') }}">
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
                        <a href="{{ route('laporan.create') }}" class="btn btn-social btn-sm btn-success">
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
                            <th>Nama Dokumen</th>
                            <th>Ekstensi</th>
                            <th>Ukuran</th>
                            <th>Download Sebanyak</th>
                            <th class="text-center" style="width: 80px">Dokumen</th>
                            <th class="text-center" style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <Tbody>
                        @forelse ($laporans as $laporan)
                            <tr>
                                <td class="text-center">{{ $laporans->firstItem() + $loop->index }}</td>
                                <td>{{ $laporan->nama_dokumen }}</td>
                                <td>.{{ $laporan->ekstensi }}</td>
                                <td>{{ $laporan->ukuran }}Kb</td>
                                <td>{{ $laporan->download ?? 0 }} Kali</td>
                                <td class="text-center">
                                    <div class="btn-group d-flex">
                                        <a href="{{ route('laporan.download', $laporan->id) }}"
                                            class="btn btn-default btn-sm text-green" target="_blank"><i
                                                class="fa fa-file-archive-o"></i></a>
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group d-flex">
                                        <a href="{{ route('laporan.edit', $laporan->id) }}"
                                            class="btn btn-default btn-sm text-green"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST"
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
                                <td colspan="7" class="text-center">
                                    Data dokumen belum Tersedia.
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
                        {{ $laporans->firstItem() }}
                        hingga
                        {{ $laporans->lastItem() }}
                        dari
                        {{ $laporans->total() }} entri
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $laporans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
