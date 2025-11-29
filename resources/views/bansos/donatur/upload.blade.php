@extends('layouts.first')
@section('title')
    Donasi Program
@endsection
@section('content')
    <div class="container" style="max-width: 1200px; margin-top: 130px; margin-bottom: 240px;">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">

                        <h4 class="text-center mb-4">📤 Upload Bukti Transfer</h4>

                        <div class="mb-3">
                            <h6 class="mb-1"><i class="bi bi-heart-fill text-danger me-1"></i> Donasi untuk:</h6>
                            <p class="ms-4 text-muted">{{ $donasi->bansos->title }}</p>

                            <h6 class="mb-1"><i class="bi bi-person-fill me-1"></i> Nama:</h6>
                            <p class="ms-4">{{ $donasi->nama }}</p>

                            <h6 class="mb-1"><i class="bi bi-cash-coin me-1"></i> Nominal:</h6>
                            <p class="ms-4 text-success fw-bold">Rp
                                {{ number_format($donasi->nominal_donasi, 0, ',', '.') }}</p>
                        </div>

                        <form action="{{ route('donatur.upload.store', $donasi->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="image" class="form-label fw-semibold">
                                    <i class="bi bi-upload me-1"></i> Pilih File Gambar (jpg/png)
                                </label>
                                <input type="file" name="image" class="form-control" required>
                                @error('image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100 mt-3">
                                <i class="bi bi-send-fill me-1"></i> Kirim Bukti Transfer
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
