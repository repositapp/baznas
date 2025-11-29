@extends('layouts.master')
@section('title')
    Tambah Kategori Zakat
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pengaturan
        @endslot
        @slot('li_2')
            Kategori Zakat
        @endslot
        @slot('title')
            Tambah Kategori Zakat
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Form Input</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('zakat.index') }}" class="btn btn-social btn-sm btn-default">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('zakat.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_sumbangan" class="col-sm-3 control-label">Nama Sumbangan</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama_sumbangan') is-invalid @enderror"
                                id="nama_sumbangan" name="nama_sumbangan" value="{{ old('nama_sumbangan') }}"
                                placeholder="Nama Sumbangan">
                            @error('nama_sumbangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_benda" class="col-sm-3 control-label">Jenis Benda</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('jenis_benda') is-invalid @enderror"
                                id="jenis_benda" name="jenis_benda" value="{{ old('jenis_benda') }}"
                                placeholder="Jenis Benda">
                            @error('jenis_benda')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nilai_ukuran" class="col-sm-3 control-label">Nilai/Ukuran</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nilai_ukuran') is-invalid @enderror"
                                id="nilai_ukuran" name="nilai_ukuran" value="{{ old('nilai_ukuran') }}"
                                placeholder="Nilai/Ukuran">
                            @error('nilai_ukuran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9 text-right">
                            <button type="submit" class="btn btn-social btn-success btn-sm"><i class="fa fa-save"></i>
                                Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
