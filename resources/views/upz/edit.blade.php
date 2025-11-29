@extends('layouts.master')
@section('title')
    Ubah Upz
@endsection
@push('css')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ URL::asset('build/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Master Data
        @endslot
        @slot('li_2')
            Data UPZ
        @endslot
        @slot('title')
            Ubah Upz
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Form Input</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('upz.index') }}" class="btn btn-social btn-sm btn-default">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('upz.update', $upz->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="kategoriupz_id" class="col-sm-2 control-label">Kategori UPZ</label>

                        <div class="col-sm-10">
                            <select class="form-control @error('kategoriupz_id') is-invalid @enderror" id="kategoriupz_id"
                                name="kategoriupz_id">
                                <option value="" hidden>-- Choose --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        @if (old('kategoriupz_id', $upz->kategoriupz_id) == $kategori->id) selected="selected" @endif>
                                        {{ $kategori->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategoriupz_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_upz" class="col-sm-2 control-label">Nama UPZ</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama_upz') is-invalid @enderror"
                                id="nama_upz" name="nama_upz" value="{{ old('nama_upz', $upz->nama_upz) }}"
                                placeholder="Nama UPZ">
                            @error('nama_upz')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text" class="col-sm-2 control-label">NPWP</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp"
                                name="npwp" value="{{ old('npwp', $upz->npwp) }}" placeholder="NPWP UPZ">
                            @error('npwp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_pengukuhan" class="col-sm-2 control-label">Nomor Pengukuhan</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('no_pengukuhan') is-invalid @enderror"
                                id="no_pengukuhan" name="no_pengukuhan"
                                value="{{ old('no_pengukuhan', $upz->no_pengukuhan) }}" placeholder="Nomor Pengukuhan">
                            @error('no_pengukuhan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_pengukuhan" class="col-sm-2 control-label">Tanggal Pengukuhan</label>

                        <div class="col-sm-10">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text"
                                    class="form-control pull-right @error('tgl_pengukuhan') is-invalid @enderror"
                                    id="datepicker" name="tgl_pengukuhan"
                                    value="{{ old('tgl_pengukuhan', $tanggalFormatted) }}"
                                    placeholder="Tanggal Pengukuhan">
                            </div>
                            @error('tgl_pengukuhan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-10">
                            <textarea class="form-control  @error('alamat') is-invalid @enderror" rows="3" name="alamat" id="alamat"
                                placeholder="Alamat ...">{{ old('alamat', $upz->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telepon" class="col-sm-2 control-label">Telepon</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                                name="telepon" value="{{ old('telepon', $upz->telepon) }}" placeholder="Nomor Telepon">
                            @error('telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fax" class="col-sm-2 control-label">Fax</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('fax') is-invalid @enderror" id="fax"
                                name="fax" value="{{ old('fax', $upz->fax) }}" placeholder="Nomor Fax">
                            @error('fax')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $upz->email) }}"
                                placeholder="Alamat Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="submit" class="btn btn-social btn-success btn-sm"><i class="fa fa-save"></i>
                                Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <!-- bootstrap datepicker -->
    <script src="{{ URL::asset('build/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>

    <script>
        $(function() {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })
        })
    </script>
@endpush
