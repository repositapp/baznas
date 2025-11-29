@extends('layouts.first')
@section('title')
    Donasi Program
@endsection
@section('content')
    {{-- <div class="container" style="max-width: 500px; margin-top: 130px; margin-bottom: 100px;">

        <!-- Info Program -->
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <img src="{{ asset('storage/' . $bansos->image) }}" alt="{{ $bansos->title }}" width="60" class="me-3">
                <div>
                    <small>Anda berdonasi untuk:</small><br>
                    <strong>{{ $bansos->title }}</strong>
                </div>
            </div>
        </div>

        <!-- Form Donasi -->
        <form action="{{ route('donatur.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="bansos_id" value="{{ $bansos->id }}">

            <!-- Nominal Donasi -->
            <div class="card mb-3">
                <div class="card-body">
                    <label for="nominal_donasi" class="form-label">Nominal Donasi</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text">Rp</span>
                        <input type="number" min="0" name="nominal_donasi" id="nominal_donasi"
                            class="form-control @error('title') is-invalid @enderror" placeholder="0"
                            value="{{ old('nominal_donasi') }}" required>
                        @error('nominal_donasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="card mb-3">
                <div class="card-body">
                    <label for="akunbank_id" class="form-label">Pilih Metode Pembayaran</label>
                    <select name="akunbank_id" id="akunbank_id"
                        class="form-select @error('akunbank_id') is-invalid @enderror"" required>
                        <option value="" disabled selected>Pilih</option>
                        @foreach ($akunbanks as $akun)
                            <option value="{{ $akun->id }}"
                                @if (old('akunbank_id') == $akun->id) selected="selected" @endif>{{ $akun->nama_bank }} -
                                {{ $akun->rekening }}</option>
                        @endforeach
                    </select>
                    @error('akunbank_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Data Diri -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mb-2">
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Alamat Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                            placeholder="Nomor WA / HP" value="{{ old('telepon') }}" required>
                        @error('telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="anonim" value="1" id="anonimSwitch">
                        <label class="form-check-label" for="anonimSwitch">Donasi sebagai anonim?</label>
                    </div>

                    <div class="mb-3">
                        <textarea name="komentar" class="form-control @error('komentar') is-invalid @enderror" rows="3"
                            placeholder="Tulis Komentar (opsional)">{{ old('komentar') }}</textarea>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-success w-100"><strong>Lanjut Pembayaran</strong></button>

        </form>
    </div> --}}

    <div class="container" style="max-width: 1200px; margin-top: 130px; margin-bottom: 40px;">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card mb-3">
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ asset('storage/' . $bansos->image) }}" alt="{{ $bansos->title }}" width="60"
                            class="me-3">
                        <div>
                            <small>Anda berdonasi untuk:</small><br>
                            <strong>{{ $bansos->title }}</strong>
                        </div>
                    </div>
                </div>

                <form action="{{ route('donatur.store') }}" method="POST">
                    @csrf
                    <div class="card shadow-sm border-0 rounded-3 mb-3">
                        <div class="card-body">
                            <label class="form-label fw-semibold">Nominal Donasi</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="nominal_donasi" class="form-control"
                                    value="{{ old('nominal_donasi', 10000) }}" required>
                            </div>
                            <small class="text-muted">Minimal Rp 10.000</small>

                            <div class="mb-4"></div>

                            <label class="form-label fw-semibold">Pilih Metode Pembayaran</label>
                            <select name="akunbank_id" class="form-select mb-4" required>
                                <option value="">-- Pilih Rekening --</option>
                                @foreach ($akunbanks as $rek)
                                    <option value="{{ $rek->id }}">
                                        {{ $rek->nama_bank }} - {{ $rek->rekening }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="text-center mb-2">
                                <h6>Informasi Donatur</h6>
                            </div>

                            <input type="text" name="nama" class="form-control mb-3" placeholder="Nama Lengkap"
                                required value="{{ old('nama') }}">
                            <input type="email" name="email" class="form-control mb-3" placeholder="Alamat Email"
                                required value="{{ old('email') }}">
                            <input type="text" name="telepon" class="form-control mb-3" placeholder="Nomor WA / HP"
                                required value="{{ old('telepon') }}">

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="anonim" value="1"
                                    id="anonimSwitch">
                                <label class="form-check-label" for="anonimSwitch">Donasi sebagai anonim?</label>
                            </div>

                            <textarea name="komentar" class="form-control mb-3" rows="3" placeholder="Komentar (opsional)">{{ old('komentar') }}</textarea>

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
