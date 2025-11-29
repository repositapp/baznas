@extends('layouts.master')
@section('title')
    Penyaluran Bantuan Sosial
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Bantuan Sosial
        @endslot
        @slot('li_2')
            Penyaluran Bantuan Sosial
        @endslot
        @slot('title')
            Penyaluran Bantuan Sosial
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        <form action="{{ route('bansos-penyaluran.index') }}">
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
                        <a href="{{ route('bansos-penyaluran.create') }}" class="btn btn-social btn-sm btn-success">
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
                            <th>Program</th>
                            <th>Penyaluran</th>
                            <th style="width: 150px">Jumlah Penerima</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th class="text-center" style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <Tbody>
                        @forelse ($penyalurans as $penyaluran)
                            <tr>
                                <td class="text-center">{{ $penyalurans->firstItem() + $loop->index }}</td>
                                <td>{{ $penyaluran->bansos->title }}</td>
                                <td>{{ $penyaluran->title }}</td>
                                <td>{{ $penyaluran->jumlah_penerima }} Orang</td>
                                <td>Rp {{ number_format($penyaluran->total_nominal, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($penyaluran->created_at)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group d-flex">
                                        <a href="{{ route('bansos-penyaluran.edit', $penyaluran->id) }}"
                                            class="btn btn-default btn-sm text-green"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('bansos-penyaluran.destroy', $penyaluran->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                            class="d-inline">
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
                                    Data penyaluran bansos belum Tersedia.
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
