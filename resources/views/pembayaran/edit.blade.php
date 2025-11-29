@extends('layouts.master')
@section('title')
    Ubah Pembayaran
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
            Pembayaran
        @endslot
        @slot('li_2')
            Data Pembayaran
        @endslot
        @slot('title')
            Ubah Pembayaran
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Form Input</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-social btn-sm btn-default">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_bayar" class="col-sm-3 control-label">Tanggal <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text"
                                            class="form-control pull-right @error('tgl_bayar') is-invalid @enderror"
                                            id="datepicker" name="tgl_bayar"
                                            value="{{ old('tgl_bayar', $tanggalFormatted) }}" placeholder="dd/mm/yyyy">
                                    </div>
                                    @error('tgl_bayar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="muzaki_id" class="col-sm-3 control-label">Muzaki <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('muzaki_id') is-invalid @enderror"
                                        id="muzaki_id" name="muzaki_id">
                                        <option value="" hidden>-- Choose --</option>
                                        @foreach ($muzakis as $muzaki)
                                            <option value="{{ $muzaki->id }}"
                                                @if (old('muzaki_id', $pembayaran->muzaki_id) == $muzaki->id) selected="selected" @endif>
                                                {{ $muzaki->nik }} - {{ $muzaki->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('muzaki_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="zakat_id" class="col-sm-3 control-label">Jenis <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('zakat_id') is-invalid @enderror"
                                        id="zakat_id" name="zakat_id">
                                        <option value="" hidden>-- Choose --</option>
                                        @foreach ($zakats as $zakat)
                                            <option value="{{ $zakat->id }}"
                                                @if (old('zakat_id', $pembayaran->zakat_id) == $zakat->id) selected="selected" @endif>
                                                {{ $zakat->nama_sumbangan }} - {{ $zakat->jenis_benda }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('zakat_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_pembayaran" class="col-sm-3 control-label">Sumbangan</label>

                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control @error('jenis_pembayaran') is-invalid @enderror"
                                        id="jenis_pembayaran" name="jenis_pembayaran"
                                        value="{{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) }}"
                                        placeholder="Nama Sumbangan">
                                    @error('jenis_pembayaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="metode_bayar" class="col-sm-3 control-label">Metode Bayar</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('metode_bayar') is-invalid @enderror"
                                        id="metode_bayar" name="metode_bayar"
                                        value="{{ old('metode_bayar', $pembayaran->metode_bayar) }}"
                                        placeholder="Metode Pembayaran">
                                    @error('metode_bayar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nilai_ukur" class="col-sm-3 control-label">Nilai/Ukuran</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('nilai_ukur') is-invalid @enderror"
                                        id="nilai_ukur" name="nilai_ukur"
                                        value="{{ old('nilai_ukur', $pembayaran->nilai_ukur) }}"
                                        placeholder="Nilai/Ukuran">
                                    @error('nilai_ukur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_keluarga" class="col-sm-3 control-label">Keluarga <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control @error('jumlah_keluarga') is-invalid @enderror"
                                        id="jumlah_keluarga" name="jumlah_keluarga"
                                        value="{{ old('jumlah_keluarga', $pembayaran->jumlah_keluarga) }}"
                                        placeholder="Jumlah Anggota Keluarga">
                                    @error('jumlah_keluarga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="total" class="col-sm-3 control-label">Total <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('total') is-invalid @enderror"
                                        id="total" name="total" value="{{ old('total', $pembayaran->total) }}"
                                        placeholder="Total Bayar">
                                    @error('total')
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
            $('#muzaki_id').select2();
            $('#zakat_id').select2();
        });

        const inputNilai = document.getElementById('nilai_ukur');
        const inputJumlah = document.getElementById('jumlah_keluarga');
        const inputTotal = document.getElementById('total');

        function hitungTotal() {
            const nilai = parseFloat(inputNilai.value);
            const jumlah = parseFloat(inputJumlah.value);

            if (!isNaN(nilai) && !isNaN(jumlah)) {
                inputTotal.value = nilai * jumlah;
            } else {
                inputTotal.value = '';
            }
        }

        inputJumlah.addEventListener('input', function() {
            hitungTotal();
        });

        $('#zakat_id').on('change', function() {
            let zakatId = $(this).val();

            if (zakatId) {
                $.ajax({
                    url: '/panel/pembayaran/zakat/' + zakatId,
                    type: 'GET',
                    success: function(data) {
                        $('#jenis_pembayaran').val(data.nama_sumbangan);
                        $('#metode_bayar').val(data.jenis_benda);
                        $('#nilai_ukur').val(data.nilai_ukuran);
                        hitungTotal();
                    }
                });
            } else {
                $('#jenis_pembayaran').val('Gagal');
                $('#metode_bayar').val('Gagal');
                $('#nilai_ukur').val('Gagal');
            }
        });
    </script>
@endpush
