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
                    <li class="current">Program</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                @forelse ($programs as $program)
                    @php
                        $terkumpul = $program->jumlah_donasi;
                        $totalDonasi = $program->donaturs ? $program->donaturs->sum('nominal_donasi') : 0;
                        $persen = $program->jumlah_donasi > 0 ? ($totalDonasi / $program->jumlah_donasi) * 100 : 0;
                        $sisaHari = \Carbon\Carbon::now()->diffInDays(
                            \Carbon\Carbon::parse($program->range_end),
                            false,
                        );
                    @endphp
                    <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="{{ route('program.show', $program->slug) }}">
                            <div class="post-item position-relative h-100 shadow-sm rounded border" data-aos="fade-up"
                                data-aos-delay="100">
                                <div class="post-img position-relative overflow-hidden">
                                    @if ($program->image)
                                        <img src="{{ asset('storage/' . $program->image) }}" class="img-fluid w-100"
                                            alt="Gambar {{ $program->title }}">
                                    @else
                                        <img src="{{ URL::asset('dist/img/blog/blog-1.jpg') }}" class="img-fluid w-100"
                                            alt="Gambar {{ $program->title }}">
                                    @endif
                                </div>
                                <div class="post-content d-flex flex-column p-3">
                                    <h5 class="post-title fw-bold">{{ $program->title }}</h5>

                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: {{ $persen }}%" aria-valuenow="{{ $persen }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="d-flex justify-content-between small text-muted">
                                        <span>Rp
                                            {{ number_format($totalDonasi, 0, ',', '.') }}
                                            ({{ number_format($persen, 0) }}%)
                                            <br><small>Terkumpul dari Rp
                                                {{ number_format($terkumpul, 0, ',', '.') }}</small></span>
                                        <span>{{ $sisaHari < 0 ? 0 : $sisaHari }}<br><small>hari lagi</small></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Belum ada program tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </section>
    <!-- /Blog Posts Section -->

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">
        <div class="container">
            <div class="d-flex justify-content-center">
                {{ $programs->links() }}
            </div>
        </div>
    </section>
    <!-- /Blog Pagination Section -->
@endsection
