@extends('layouts.master')
@section('title')
    Tambah Program
@endsection
@push('css')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ URL::asset('build/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Bantuan Sosial
        @endslot
        @slot('li_2')
            Program
        @endslot
        @slot('title')
            Tambah Program
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Form Input</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('program.index') }}" class="btn btn-social btn-sm btn-default">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('program.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Program <span class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}" placeholder="Nama Program">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="range_start" class="col-sm-2 control-label">Tanggal Mulai <span
                                class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text"
                                    class="form-control pull-right @error('range_start') is-invalid @enderror"
                                    id="range_start" name="range_start"
                                    value="{{ old('range_start', \Carbon\Carbon::parse(now())->translatedFormat('m/d/Y')) }}"
                                    placeholder="mm/dd/yyyy">
                            </div>
                            @error('range_start')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="range_end" class="col-sm-2 control-label">Tanggal Selesai <span
                                class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text"
                                    class="form-control pull-right @error('range_end') is-invalid @enderror" id="range_end"
                                    name="range_end"
                                    value="{{ old('range_end', \Carbon\Carbon::parse(now())->translatedFormat('m/d/Y')) }}"
                                    placeholder="mm/dd/yyyy">
                            </div>
                            @error('range_end')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_donasi" class="col-sm-2 control-label">Jumlah Donasi <span
                                class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Rp.
                                </div>
                                <input type="text" class="form-control @error('jumlah_donasi') is-invalid @enderror"
                                    id="jumlah_donasi" name="jumlah_donasi" value="{{ old('jumlah_donasi') }}"
                                    placeholder="Jumlah Donasi">
                            </div>
                            @error('jumlah_donasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">Banner <span class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            <small class="text-danger">Ukuran File Maksimal 2MB</small>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body" class="col-sm-2 control-label">Redaksi <span class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <textarea class="tinymce  @error('body') is-invalid @enderror" rows="10" name="body" id="body">{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="submit" id="btn-simpan" class="btn btn-social btn-success btn-sm"><i
                                    class="fa fa-save"></i>
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
    <!-- tinymce -->
    <script src="{{ URL::asset('build/plugins/tinymce/tinymce.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/tinymce/form-editor-tiny.init.js') }}"></script>

    <script>
        $(function() {
            //Date picker
            $('#range_start').datepicker({
                autoclose: true
            });
            $('#range_end').datepicker({
                autoclose: true
            });
        });
    </script>
@endpush
