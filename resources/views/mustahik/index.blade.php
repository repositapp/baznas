@extends('layouts.master')
@section('title')
    Data Mustahik
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Master Data
        @endslot
        @slot('li_2')
            Data Mustahik
        @endslot
        @slot('title')
            Data Mustahik
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        <form action="{{ route('mustahik.index') }}">
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
                        <a href="{{ route('mustahik.create') }}" class="btn btn-social btn-sm btn-success">
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
                            <th>UPZ</th>
                            <th>Golongan</th>
                            <th>Kepala Keluarga</th>
                            <th>Anggota Keluarga</th>
                            <th>Pekerjaan</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th class="text-center" style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <Tbody>
                        @forelse ($mustahiks as $mustahik)
                            <tr>
                                <td class="text-center">{{ $mustahiks->firstItem() + $loop->index }}</td>
                                <td>{{ $mustahik->upz->nama_upz }}</td>
                                <td>{{ $mustahik->golongan->name }}</td>
                                <td>{{ $mustahik->nama }}</td>
                                <td>{{ $mustahik->anggota_keluarga }} Orang</td>
                                <td>{{ $mustahik->pekerjaan }}</td>
                                <td>{{ $mustahik->telepon }}</td>
                                <td>{{ $mustahik->alamat_rumah }}</td>
                                <td class="text-center">
                                    <div class="btn-group d-flex">
                                        <a href="{{ route('mustahik.edit', $mustahik->id) }}"
                                            class="btn btn-default btn-sm text-green"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('mustahik.destroy', $mustahik->id) }}" method="POST"
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
                                <td colspan="8" class="text-center">
                                    Data Mustahik belum Tersedia.
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
                        {{ $mustahiks->firstItem() }}
                        hingga
                        {{ $mustahiks->lastItem() }}
                        dari
                        {{ $mustahiks->total() }} entri
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $mustahiks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
