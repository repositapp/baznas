@extends('layouts.first')
@section('title')
    Program
@endsection
@section('content')
    <div class="page-title dark-background" style="background-image: url('{{ URL::asset('dist/img/page-title-bg.jpg') }}');">
        <div class="container position-relative">
            <h1>Program</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index') }}">Beranda</a></li>
                    <li><a href="{{ url('/program') }}">Program</a></li>
                    <li class="current">Detail Program</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <article class="article" data-aos="fade-right" data-aos-delay="100">
                        <h2 class="title">{{ $program->title }}</h2>
                        <div class="post-img">
                            @if ($program->image)
                                <img src="{{ asset('storage/' . $program->image) }}" class="img-fluid"
                                    alt="Gambar {{ $program->title }}">
                            @else
                                <img src="{{ URL::asset('dist/img/blog/blog-6.jpg') }}" class="img-fluid"
                                    alt="Gambar {{ $program->title }}">
                            @endif
                        </div>
                        <div class="content">
                            <!-- Features Section -->
                            <section id="features" class="features section" style="padding: 10px 0;">
                                <ul class="nav nav-tabs row  g-2 d-flex" data-aos="fade-up" data-aos-delay="100"
                                    role="tablist">
                                    <li class="nav-item col-4" role="presentation">
                                        <a class="nav-link active show" data-bs-toggle="tab"
                                            data-bs-target="#features-tab-1" aria-selected="true" role="tab">
                                            <h4>Detail</h4>
                                        </a>
                                    </li><!-- End tab nav item -->

                                    <li class="nav-item col-4" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2"
                                            aria-selected="false" tabindex="-1" role="tab">
                                            <h4>Update</h4>
                                        </a><!-- End tab nav item -->

                                    </li>
                                    <li class="nav-item col-4" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3"
                                            aria-selected="false" tabindex="-1" role="tab">
                                            <h4>Donatur</h4>
                                        </a>
                                    </li><!-- End tab nav item -->
                                </ul>

                                <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
                                    <div class="tab-pane fade active show" id="features-tab-1" role="tabpanel">
                                        <div class="row">
                                            <div
                                                class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                                                <p>{!! $program->body !!}</p>
                                            </div>
                                        </div>
                                    </div><!-- End tab content item -->

                                    <div class="tab-pane fade" id="features-tab-2" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12 mt-3 mt-lg-0">
                                                @if ($program->bansossaluran->count())
                                                    <ul class="timeline">
                                                        @foreach ($program->bansossaluran as $saluran)
                                                            <li class="timeline-item mb-5">
                                                                <h5 class="fw-bold text-success mb-1">
                                                                    {{ $saluran->title ?? 'Penyaluran Bansos' }}</h5>
                                                                <div class="text-muted mb-2">
                                                                    {{ \Carbon\Carbon::parse($saluran->created_at)->translatedFormat('d M Y') }}
                                                                </div>
                                                                <div class="card border-0 shadow-sm">
                                                                    @if ($saluran->image)
                                                                        <img src="{{ asset('storage/' . $saluran->image) }}"
                                                                            class="card-img-top" alt="Gambar Penyaluran"
                                                                            style="max-height: 300px; object-fit: cover;">
                                                                    @endif
                                                                    <div class="card-body">
                                                                        {!! $saluran->body !!}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p class="text-muted">Belum ada penyaluran untuk program ini.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- End tab content item -->

                                    <div class="tab-pane fade" id="features-tab-3" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12 mt-3 mt-lg-0">
                                                @if ($program->donaturs && $program->donaturs->count())
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($program->donaturs->sortByDesc('created_at') as $donatur)
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <div class="me-3">
                                                                    <img src="{{ URL::asset('dist/img/user-default.png') }}"
                                                                        alt="Avatar"
                                                                        style="width: 65px; height: 65px; border-radius: 50%;">
                                                                </div>
                                                                <div>
                                                                    <strong>{{ $donatur->nama ?? 'Anonim' }}</strong><br>
                                                                    <span class="text-success fw-bold">Rp
                                                                        {{ number_format($donatur->nominal_donasi, 0, ',', '.') }}</span><br>
                                                                    <small class="text-muted">
                                                                        {{ \Carbon\Carbon::parse($donatur->created_at)->translatedFormat('d M Y') }}
                                                                    </small>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p class="text-muted">Belum ada donatur untuk program ini.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End tab content item -->
                                </div>
                            </section><!-- /Features Section -->
                        </div>
                    </article>
                </section>
            </div>
            <div class="col-lg-4 sidebar">
                @php
                    $totalDonasi = $program->donaturs ? $program->donaturs->sum('nominal_donasi') : 0;
                    $persen = $program->jumlah_donasi > 0 ? ($totalDonasi / $program->jumlah_donasi) * 100 : 0;
                    $sisaHari = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($program->range_end), false);
                @endphp
                <div class="widgets-container" data-aos="fade-left" data-aos-delay="200">
                    <div class="card mb-4" style="width: 100%; max-width: 360px; border:1px solid #ddd;">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Rp {{ number_format($totalDonasi, 0, ',', '.') }}</strong></h5>
                            <p class="card-text">Terkumpul dari Rp
                                {{ number_format($program->jumlah_donasi, 0, ',', '.') }}
                            </p>

                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $persen }}%" aria-valuenow="{{ $persen }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <small>{{ number_format($persen, 0) }}% Terkumpul</small>
                                <small>{{ $sisaHari }} hari lagi</small>
                            </div>

                            <a href="{{ route('donatur.create', $program->slug) }}"
                                class="btn btn-success btn-lg w-100 mb-3"><strong>Donasi
                                    Sekarang</strong></a>

                            <p class="mb-1">Bagikan ke :</p>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                    target="_blank" class="btn btn-outline-primary btn-sm w-50">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank"
                                    class="btn btn-outline-success btn-sm w-50">
                                    <i class="bi bi-whatsapp"></i> Whatsapp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
