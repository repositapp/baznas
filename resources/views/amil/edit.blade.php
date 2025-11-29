@extends('layouts.master')
@section('title')
    Ubah Amil
@endsection
@push('css')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ URL::asset('build/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('build/bower_components/select2/dist/css/select2.min.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Master Data
        @endslot
        @slot('li_2')
            Data Amil
        @endslot
        @slot('title')
            Ubah Amil
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Form Input</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('amil.index') }}" class="btn btn-social btn-sm btn-default">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('amil.update', $amil->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id" class="col-sm-3 control-label">Akun Amil <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('user_id') is-invalid @enderror"
                                        id="user_id" name="user_id">
                                        <option value="" hidden>-- Choose --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if (old('user_id', $amil->user_id) == $user->id) selected="selected" @endif>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="upz_id" class="col-sm-3 control-label">UPZ <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('upz_id') is-invalid @enderror"
                                        id="upz_id" name="upz_id">
                                        <option value="" hidden>-- Choose --</option>
                                        @foreach ($upzs as $upz)
                                            <option value="{{ $upz->id }}"
                                                @if (old('upz_id', $amil->upz_id) == $upz->id) selected="selected" @endif>
                                                {{ $upz->nama_upz }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('upz_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-3 control-label">Nama <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $amil->nama) }}"
                                        placeholder="Nama Amil">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nik" class="col-sm-3 control-label">Nik</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" value="{{ old('nik', $amil->nik) }}"
                                        placeholder="Nik Amil">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir" class="col-sm-3 control-label">Tempat Lahir</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        id="tempat_lahir" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $amil->tempat_lahir) }}" placeholder="Tempat Lahir">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir" class="col-sm-3 control-label">Tanggal Lahir</label>

                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text"
                                            class="form-control pull-right @error('tanggal_lahir') is-invalid @enderror"
                                            id="datepicker" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $tanggalFormatted) }}"
                                            placeholder="Tanggal Lahir">
                                    </div>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin" class="col-sm-3 control-label">Jenis Kelamin <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="" hidden>-- Choose --</option>
                                        <option value="Laki-Laki"
                                            @if (old('jenis_kelamin', $amil->jenis_kelamin) == 'Laki-Laki') selected="selected" @endif>
                                            Laki-Laki
                                        </option>
                                        <option value="Perempuan"
                                            @if (old('jenis_kelamin', $amil->jenis_kelamin) == 'Perempuan') selected="selected" @endif>
                                            Perempuan
                                        </option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan" class="col-sm-3 control-label">Pekerjaan</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                        id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $amil->pekerjaan) }}"
                                        placeholder="Pekerjaan">
                                    @error('pekerjaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-sm-3 control-label">Keterangan</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control  @error('keterangan') is-invalid @enderror" rows="1" name="keterangan"
                                        id="keterangan" placeholder="Keterangan ...">{{ old('keterangan', $amil->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_kantor" class="col-sm-3 control-label">Alamat Kantor</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control  @error('alamat_kantor') is-invalid @enderror" rows="1" name="alamat_kantor"
                                        id="alamat_kantor" placeholder="Alamat Kantor ...">{{ old('alamat_kantor', $amil->alamat_kantor) }}</textarea>
                                    @error('alamat_kantor')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_rumah" class="col-sm-3 control-label">Alamat Rumah <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <textarea class="form-control  @error('alamat_rumah') is-invalid @enderror" rows="1" name="alamat_rumah"
                                        id="alamat_rumah" placeholder="Alamat Rumah ...">{{ old('alamat_rumah', $amil->alamat_rumah) }}</textarea>
                                    @error('alamat_rumah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="col-sm-3 control-label">Telepon <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                        id="telepon" name="telepon" value="{{ old('telepon', $amil->telepon) }}"
                                        placeholder="Nomor Telepon">
                                    @error('telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9 text-right">
                            <button type="submit" class="btn btn-social btn-success btn-sm"><i class="fa fa-save"></i>
                                Simpan</button>
                        </div>
                    </div>
                    <p>Catatan : (<span class="text-red">*</span>) Wajib diisi.</p>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <!-- bootstrap datepicker -->
    <script src="{{ URL::asset('build/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <!-- Select2 -->
    <script src="{{ URL::asset('build/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            //Initialize Select2 Elements
            $('#user_id').select2();
            $('#upz_id').select2();
        })
    </script>
@endpush
