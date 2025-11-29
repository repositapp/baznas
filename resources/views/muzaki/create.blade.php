@extends('layouts.master')
@section('title')
    Tambah Muzaki
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
            Data Muzaki
        @endslot
        @slot('title')
            Tambah Muzaki
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Form Input</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('muzaki.index') }}" class="btn btn-social btn-sm btn-default">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('muzaki.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="col-sm-3 control-label">Nama <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Muzaki">
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
                                        id="nik" name="nik" value="{{ old('nik') }}" placeholder="Nik Muzaki">
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
                                        id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                        placeholder="Tempat Lahir">
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
                                            value="{{ old('tanggal_lahir', \Carbon\Carbon::parse(now())->translatedFormat('m/d/Y')) }}"
                                            placeholder="Tanggal Lahir">
                                    </div>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin" class="col-sm-3 control-label">Jenis Kelamin <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="" hidden>-- Choose --</option>
                                        <option value="Laki-Laki"
                                            @if (old('jenis_kelamin') == 'Laki-Laki') selected="selected" @endif>
                                            Laki-Laki
                                        </option>
                                        <option value="Perempuan"
                                            @if (old('jenis_kelamin') == 'Perempuan') selected="selected" @endif>
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
                                <label for="alamat_rumah" class="col-sm-3 control-label">Alamat Rumah</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control  @error('alamat_rumah') is-invalid @enderror" rows="1" name="alamat_rumah"
                                        id="alamat_rumah" placeholder="Alamat Rumah ...">{{ old('alamat_rumah') }}</textarea>
                                    @error('alamat_rumah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan" class="col-sm-3 control-label">Pekerjaan <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                        id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                        placeholder="Pekerjaan">
                                    @error('pekerjaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nip" class="col-sm-3 control-label">NIP</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                        id="nip" name="nip" value="{{ old('nip') }}"
                                        placeholder="Nomor Induk Pegawai">
                                    @error('nip')
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
                                        id="keterangan" placeholder="Keterangan ...">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_kantor" class="col-sm-3 control-label">Alamat Kantor <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <textarea class="form-control  @error('alamat_kantor') is-invalid @enderror" rows="1" name="alamat_kantor"
                                        id="alamat_kantor" placeholder="Alamat Kantor ...">{{ old('alamat_kantor') }}</textarea>
                                    @error('alamat_kantor')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="col-sm-3 control-label">Telepon</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                        id="telepon" name="telepon" value="{{ old('telepon') }}"
                                        placeholder="Nomor Telepon">
                                    @error('telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-9">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Alamat Email">
                                    @error('email')
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

    <script>
        $(function() {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
        })
    </script>
@endpush
