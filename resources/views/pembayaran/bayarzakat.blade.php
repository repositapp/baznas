@extends('layouts.first')
@section('title')
    Bayar Zakat
@endsection
@section('content')
    <div class="container" style="max-width:1600px; margin-top: 130px; margin-bottom: 40px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('bayarzakat.store') }}" method="POST">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <label class="form-label fw-semibold">Anda Ber-zakat untuk:</label>
                            <select id="zakat_id" name="zakat_id" class="form-select" required>
                                <option value="">-- Pilih Jenis Zakat --</option>
                                @foreach ($zakats->skip(2) as $zakat)
                                    <option value="{{ $zakat->id }}"
                                        @if (old('zakat_id') == $zakat->id) selected="selected" @endif>
                                        {{ $zakat->nama_sumbangan }}
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

                    <div class="card shadow-sm border-0 rounded-3 mb-3">
                        <div class="card-body">
                            <label class="form-label fw-semibold">Nominal Zakat</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="total" class="form-control" value="{{ old('total', 10000) }}"
                                    required>
                            </div>
                            @error('total')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Minimal Rp 10.000</small>

                            <div class="mb-2"></div>

                            <label class="form-label fw-semibold">Pilih Metode Pembayaran</label>
                            <select name="akunbank_id" class="form-select mb-4" required>
                                <option value="">-- Pilih Rekening --</option>
                                @foreach ($akunbanks as $rek)
                                    <option value="{{ $rek->id }}">
                                        {{ $rek->nama_bank }} - {{ $rek->rekening }}
                                    </option>
                                @endforeach
                            </select>
                            @error('akunbank_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="text-center mb-3">
                                <h6>Informasi Pembayar Zakat</h6>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-3 @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Nama Muzaki">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <input type="text" class="form-control mb-3 @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" value="{{ old('nik') }}" placeholder="Nik Muzaki">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <select class="form-control mb-3 @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="" hidden>-- Pilih Jenis Kelamin --</option>
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

                                    <textarea class="form-control mb-3  @error('alamat_rumah') is-invalid @enderror" rows="3" name="alamat_rumah"
                                        id="alamat_rumah" placeholder="Alamat Rumah ...">{{ old('alamat_rumah') }}</textarea>
                                    @error('alamat_rumah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-3 @error('telepon') is-invalid @enderror"
                                        id="telepon" name="telepon" value="{{ old('telepon') }}"
                                        placeholder="Nomor Telepon">
                                    @error('telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <input type="email" class="form-control mb-3 @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Alamat Email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <input type="text" class="form-control mb-3 @error('pekerjaan') is-invalid @enderror"
                                        id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                        placeholder="Pekerjaan">
                                    @error('pekerjaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <textarea class="form-control mb-3  @error('alamat_kantor') is-invalid @enderror" rows="3" name="alamat_kantor"
                                        id="alamat_kantor" placeholder="Alamat Kantor ...">{{ old('alamat_kantor') }}</textarea>
                                    @error('alamat_kantor')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>


                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-arrow-right-circle me-1"></i> Lanjut Pembayaran
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
