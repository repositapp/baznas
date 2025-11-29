@extends('layouts.master')
@section('title')
    Tambah Penyaluran
@endsection
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('build/bower_components/select2/dist/css/select2.min.css') }}">
@endpush
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Bantuan Sosial
        @endslot
        @slot('li_2')
            Penyaluran Bantuan Sosial
        @endslot
        @slot('title')
            Tambah Penyaluran
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Form Input</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('bansos-penyaluran.index') }}" class="btn btn-social btn-sm btn-default">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('bansos-penyaluran.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="bansos_id" class="col-sm-2 control-label">Program <span
                                class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <select class="form-control select2 @error('bansos_id') is-invalid @enderror" id="bansos_id"
                                name="bansos_id">
                                <option value="" hidden>-- Choose --</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}"
                                        @if (old('bansos_id') == $program->id) selected="selected" @endif> {{ $program->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bansos_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Nama Penyaluran <span
                                class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}" placeholder="Nama Penyaluran">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_penerima" class="col-sm-2 control-label">Jumlah Penerima <span
                                class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('jumlah_penerima') is-invalid @enderror"
                                id="jumlah_penerima" name="jumlah_penerima" value="{{ old('jumlah_penerima') }}"
                                placeholder="Jumlah Penerima">
                            @error('jumlah_penerima')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_nominal" class="col-sm-2 control-label">Total <span
                                class="text-red">*</span></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('total_nominal') is-invalid @enderror"
                                id="total_nominal" name="total_nominal" value="{{ old('total_nominal') }}"
                                placeholder="Total">
                            @error('total_nominal')
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
    <!-- Select2 -->
    <script src="{{ URL::asset('build/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- tinymce -->
    <script src="{{ URL::asset('build/plugins/tinymce/tinymce.js') }}"></script>
    <script src="{{ URL::asset('build/plugins/tinymce/form-editor-tiny.init.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('#bansos_id').select2();
        });
    </script>
@endpush
