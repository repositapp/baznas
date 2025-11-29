@extends('layouts.master')
@section('title')
    Tambah Penyaluran
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
            Penyaluran
        @endslot
        @slot('li_2')
            Data Penyaluran
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
                    <a href="{{ route('penyaluran.index') }}" class="btn btn-social btn-sm btn-default">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('penyaluran.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_penyaluran" class="col-sm-3 control-label">Tanggal <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text"
                                            class="form-control pull-right @error('tgl_penyaluran') is-invalid @enderror"
                                            id="datepicker" name="tgl_penyaluran"
                                            value="{{ old('tgl_penyaluran', \Carbon\Carbon::parse(now())->translatedFormat('m/d/Y')) }}"
                                            placeholder="dd/mm/yyyy">
                                    </div>
                                    @error('tgl_penyaluran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mustahik_id" class="col-sm-3 control-label">Mustahik <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('mustahik_id') is-invalid @enderror"
                                        id="mustahik_id" name="mustahik_id">
                                        <option value="" hidden>-- Choose --</option>
                                        @foreach ($mustahiks as $mustahik)
                                            <option value="{{ $mustahik->id }}"
                                                @if (old('mustahik_id') == $mustahik->id) selected="selected" @endif>
                                                {{ $mustahik->nik }} - {{ $mustahik->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small id="peringatan-fitrah" class="text-danger" style="display: none;">
                                        Mustahik ini sudah menerima zakat fitrah tahun ini.
                                    </small>
                                    @error('mustahik_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="anggota_keluarga" class="col-sm-3 control-label">Keluarga</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="anggota_keluarga" name="anggota_keluarga"
                                        placeholder="Jumlah Anggota Keluarga">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_rumah" class="col-sm-3 control-label">Alamat Rumah</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="1" name="alamat_rumah" id="alamat_rumah" placeholder="Alamat Rumah ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zakat_id" class="col-sm-3 control-label">Jenis Zakat<span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('zakat_id') is-invalid @enderror"
                                        id="zakat_id" name="zakat_id">
                                        <option value="" hidden>-- Choose --</option>
                                        @foreach ($zakats as $zakat)
                                            <option value="{{ $zakat->id }}"
                                                @if (old('zakat_id') == $zakat->id) selected="selected" @endif>
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
                                <label for="metode_bayar" class="col-sm-3 control-label">Metode Bayar</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="metode_bayar" name="metode_bayar"
                                        placeholder="Metode Pembayaran">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="total" class="col-sm-3 control-label">Total <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control @error('total') is-invalid @enderror"
                                        id="total" name="total" value="{{ old('total') }}"
                                        placeholder="Total Bayar">
                                    <small id="peringatan-saldo" class="text-danger" style="display:none;">Saldo tidak
                                        mencukupi!</small>
                                    @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="sisa_saldo" name="sisa_saldo"
                                        placeholder="Sisa Saldo" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gambar" class="col-sm-3 control-label">Dokumentasi <span
                                        class="text-red">*</span></label>

                                <div class="col-sm-9">
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar" accept="image/*">
                                    <small class="text-danger">Ukuran File Maksimal 2MB</small>
                                    @error('gambar')
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
    <!-- Select2 -->
    <script src="{{ URL::asset('build/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            //Initialize Select2 Elements
            $('#mustahik_id').select2();
            $('#zakat_id').select2();
        });

        $('#mustahik_id').on('change', function() {
            let mustahikId = $(this).val();

            if (mustahikId) {
                $.ajax({
                    url: '/panel/penyaluran/mustahik/' + mustahikId,
                    type: 'GET',
                    success: function(data) {
                        $('#anggota_keluarga').val(data.anggota_keluarga);
                        $('#alamat_rumah').val(data.alamat_rumah);
                        if (data.sudah_terima) {
                            $('#peringatan-fitrah').show();
                            $('#btn-simpan').prop('disabled', true);
                        } else {
                            $('#peringatan-fitrah').hide();
                            $('#btn-simpan').prop('disabled', false);
                        }
                    }
                });
            } else {
                $('#anggota_keluarga').val('');
                $('#alamat_rumah').val('');
                $('#peringatan-fitrah').hide();
                $('#btn-simpan').prop('disabled', false);
            }
        });

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(angka);
        }

        $('#zakat_id').on('change', function() {
            let zakatId = $(this).val();

            if (zakatId) {
                $.ajax({
                    url: '/panel/penyaluran/zakat/' + zakatId,
                    type: 'GET',
                    success: function(data) {
                        $('#metode_bayar').val(data.jenis_benda);
                        let tampilSisa = '';
                        if (data.jenis_benda.toLowerCase() === 'beras') {
                            tampilSisa = data.sisa + ' Kg';
                        } else {
                            tampilSisa = formatRupiah(data.sisa);
                        }

                        $('#sisa_saldo').val(tampilSisa);
                        $('#sisa_saldo').data('nilai-sisa', data.sisa); // Simpan angka aslinya
                        $('#total').trigger('input');
                    }
                });
            } else {
                $('#metode_bayar').val('');
                $('#sisa_saldo').val('');
            }
        });

        function rupiahToNumber(rupiah) {
            // Hilangkan simbol rupiah dan spasi
            let numberString = rupiah.replace(/[Rp.\s]/g, '');
            // Ubah koma menjadi titik (jika ada desimal)
            numberString = numberString.replace(',', '.');
            // Konversi ke angka
            return parseFloat(numberString);
        }


        $('#total').on('input', function() {
            var totalInput = parseFloat($(this).val());
            var inputAwal = $('#sisa_saldo').val().substring(0, 2);
            if (inputAwal == 'Rp') {
                var sisaSaldo = rupiahToNumber($('#sisa_saldo').val());
            } else {
                var sisaSaldo = parseFloat($('#sisa_saldo').val());
            }
            if (!isNaN(totalInput) && !isNaN(sisaSaldo)) {
                if (totalInput > sisaSaldo) {
                    $('#peringatan-saldo').show();
                    $('#btn-simpan').prop('disabled', true);
                } else {
                    $('#peringatan-saldo').hide();
                    $('#btn-simpan').prop('disabled', false);
                }
            }
        });
    </script>
@endpush
