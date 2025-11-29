@extends('layouts.master')
@section('title')
    Artikel
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Artikel
        @endslot
        @slot('li_2')
            Artikel
        @endslot
        @slot('title')
            Artikel
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        <form action="{{ route('artikel.index') }}">
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
                        <a href="{{ route('artikel.create') }}" class="btn btn-social btn-sm btn-success">
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
                            <th scope="col">Kategori</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Kutipan</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">Status</th>
                            <th class="text-center" style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <Tbody>
                        @forelse ($artikels as $artikel)
                            <tr>
                                <td class="text-center">{{ $artikels->firstItem() + $loop->index }}</td>
                                <td>{{ $artikel->kategori->name }}</td>
                                <td>{{ $artikel->judul }}</td>
                                <td>{{ $artikel->kutipan }}</td>
                                <td>{{ $artikel->author->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($artikel->created_at)->locale('id')->translatedFormat('d F Y, H:i') }}
                                </td>
                                <td>
                                    @if ($artikel->status == 0)
                                        <span class="label label-danger">Private</span>
                                    @else
                                        <span class="label label-success">Publish</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group d-flex">
                                        <a href="{{ route('artikel.edit', $artikel->id) }}"
                                            class="btn btn-default btn-sm text-green"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST"
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
                                    Data artikel belum Tersedia.
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
                        {{ $artikels->firstItem() }}
                        hingga
                        {{ $artikels->lastItem() }}
                        dari
                        {{ $artikels->total() }} entri
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $artikels->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
