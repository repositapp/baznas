@extends('layouts.first')
@section('title')
    Donasi Program
@endsection
@section('content')
    <div class="container" style="max-width: 1200px; margin-top: 130px; margin-bottom: 30px;">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">

                        <h4 class="text-center mb-4">📄 Invoice Donasi</h4>

                        <div class="mb-3">
                            <h6><i class="bi bi-heart-fill text-danger me-2"></i><strong>Program:</strong></h6>
                            <p class="ms-4">{{ $donasi->bansos->title }}</p>
                        </div>

                        <div class="mb-3">
                            <h6><i class="bi bi-person-fill me-2"></i><strong>Nama Donatur:</strong></h6>
                            <p class="ms-4">{{ $donasi->nama }}</p>

                            <h6><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong></h6>
                            <p class="ms-4">{{ $donasi->email }}</p>

                            <h6><i class="bi bi-telephone-fill me-2"></i><strong>Telepon:</strong></h6>
                            <p class="ms-4">{{ $donasi->telepon }}</p>

                            <h6><i class="bi bi-cash-coin me-2"></i><strong>Nominal Donasi:</strong></h6>
                            <p class="ms-4 text-success fw-bold">Rp
                                {{ number_format($donasi->nominal_donasi, 0, ',', '.') }}</p>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6><i class="bi bi-bank me-2"></i><strong>Transfer ke Rekening:</strong></h6>
                            <ul class="ms-4 list-unstyled">
                                <li>{{ $donasi->akunbank->nama_bank }}</li>
                                <li>No. Rek: {{ $donasi->akunbank->rekening }}</li>
                                <li>Atas Nama: {{ $donasi->akunbank->pemilik }}</li>
                            </ul>
                        </div>

                        @if ($donasi->image)
                            <div class="mb-3">
                                <h6><i class="bi bi-receipt-cutoff me-2"></i><strong>Bukti Transfer:</strong></h6>
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $donasi->image) }}" alt="Bukti Transfer"
                                        class="img-fluid rounded border shadow-sm" style="max-height: 300px;">
                                </div>
                            </div>
                        @endif

                        <div class="text-center mt-4">
                            <a href="{{ url('/') }}" class="btn btn-success px-4">
                                <i class="bi bi-house-door-fill me-1"></i> Kembali ke Beranda
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
