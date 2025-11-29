@extends('layouts.first')
@section('title')
    Artikel
@endsection
@section('content')
    <div class="page-title dark-background" style="background-image: url('{{ URL::asset('dist/img/page-title-bg.jpg') }}');">
        <div class="container position-relative">
            <h1>Artikel</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="current">Artikel</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                @foreach ($artikels as $artikel)
                    <div class="col-lg-4">
                        <article class="position-relative h-100" data-aos="fade-up" data-aos-delay="300">
                            <div class="post-img position-relative overflow-hidden">
                                @if ($artikel->gambar)
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="img-fluid"
                                        alt="{{ $artikel->kategori->name }}">
                                @else
                                    <img src="{{ URL::asset('dist/img/blog/blog-6.jpg') }}" class="img-fluid"
                                        alt="{{ $artikel->kategori->name }}">
                                @endif
                                <span class="post-date">{{ $artikel->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $artikel->judul }}</h3>
                                <div class="meta d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-folder2"></i> <span
                                            class="ps-2">{{ $artikel->kategori->name }}</span>
                                    </div>
                                </div>
                                <p>{{ $artikel->kutipan }}</p>
                                <hr>
                                <a href="{{ route('artikel.show', $artikel->slug) }}"
                                    class="readmore stretched-link"><span>Detail</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <!-- /Blog Posts Section -->

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">
        <div class="container">
            <div class="d-flex justify-content-center">
                {{ $artikels->links() }}
            </div>
        </div>
    </section>
    <!-- /Blog Pagination Section -->
@endsection
