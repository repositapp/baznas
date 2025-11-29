@extends('layouts.first')
@section('title')
    Beranda
@endsection
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div class="info d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6 text-center">
                        <h2>Badan Amil Zakat Nasional Kabupaten Buton</h2>
                        <p>BAZNAS adalah sebagai lembaga pengelola zakat yang bertugas mengumpulkan, mendistribusikan, dan
                            mendayagunakan zakat, infak, dan sedekah secara efektif dan tepat sasaran guna membantu
                            mengurangi kemiskinan, meningkatkan kesejahteraan umat, serta mendukung program-program
                            pembangunan sosial di Indonesia.</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-item">
                <img src="{{ URL::asset('dist/img/images/slider/3.png') }}" alt="">
                <div class="carousel-container">
                    <h2>Temporibus autem quibusdam</h2>
                    <p>Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt omnis iste
                        natus error sit voluptatem accusantium.</p>
                    <a href="#featured-services" class="btn-get-started">Get Started</a>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="{{ URL::asset('dist/img/images/slider/1.png') }}" alt="">
                <div class="carousel-container">
                    <h2>Temporibus autem quibusdam</h2>
                    <p>Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt omnis iste
                        natus error sit voluptatem accusantium.</p>
                    <a href="#featured-services" class="btn-get-started">Get Started</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ URL::asset('dist/img/images/slider/2.png') }}" alt="">
                <div class="carousel-container">
                    <h2>Temporibus autem quibusdam</h2>
                    <p>Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt omnis iste
                        natus error sit voluptatem accusantium.</p>
                    <a href="#featured-services" class="btn-get-started">Get Started</a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators">
                <li data-bs-target="#hero-carousel" data-bs-slide-to="0" class=""></li>
                <li data-bs-target="#hero-carousel" data-bs-slide-to="1" class="active" aria-current="true"></li>
                <li data-bs-target="#hero-carousel" data-bs-slide-to="2" class=""></li>
            </ol>
        </div>
    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="row position-relative">
                <div class="col-lg-7 about-img" data-aos="zoom-out" data-aos-delay="200">
                    <a href="https://www.youtube.com/watch?v=DcFhYSXQceY" class="glightbox stretched-link">
                        <div class="video-play"></div>
                    </a>
                    <img src="{{ URL::asset('dist/img/images/tentang/about.jpg') }}">
                </div>
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="inner-title">Tentang Kami</h2>
                    <div class="our-story">
                        <p>Badan Amil Zakat Nasional (BAZNAS) adalah lembaga resmi yang dibentuk oleh pemerintah Republik
                            Indonesia untuk mengelola zakat secara nasional. BAZNAS memiliki peran strategis dalam
                            pengumpulan, pendistribusian, dan pendayagunaan zakat, infak, dan sedekah (ZIS) serta dana
                            sosial keagamaan lainnya secara profesional, transparan, dan akuntabel. Lembaga ini bertugas
                            memastikan bahwa zakat yang dikumpulkan dari masyarakat dapat disalurkan tepat sasaran kepada
                            mustahik (penerima zakat) guna mengurangi kesenjangan sosial dan meningkatkan kesejahteraan
                            umat.</p>

                        <p>Selain mengelola zakat, BAZNAS juga aktif dalam berbagai program sosial dan pemberdayaan ekonomi
                            umat, seperti bantuan pendidikan, kesehatan, pelatihan keterampilan, dan usaha mikro. Dengan
                            pendekatan yang berbasis data dan teknologi, BAZNAS berupaya memperkuat sistem pengelolaan zakat
                            agar dapat menjangkau lebih banyak penerima manfaat secara tepat waktu dan berkelanjutan. Peran
                            BAZNAS sangat penting dalam mendukung pembangunan nasional dan upaya pengentasan kemiskinan
                            melalui dana zakat yang dikelola secara amanah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /About Section -->

    <!-- Stats Counter Section -->
    <section id="stats" class="stats section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Statistik</h2>
            <p>Statistik ZIS Kabupaten Buton</p>
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-5">
                    <img src="{{ URL::asset('dist/img/stats-img.svg') }}" alt="" class="img-fluid">
                </div>

                <div class="col-lg-7">

                    <div class="row gy-4">

                        <div class="col-lg-6">
                            <div class="stats-item d-flex">
                                <i class="bi bi-people flex-shrink-0"></i>
                                <div>
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $jumlah_muzaki }}"
                                        data-purecounter-duration="1" class="purecounter">{{ $jumlah_muzaki }}</span>
                                    <p><strong>Total Muzaki</strong></p>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-6">
                            <div class="stats-item d-flex">
                                <i class="bi bi-people flex-shrink-0"></i>
                                <div>
                                    <span data-purecounter-start="0" data-purecounter-end="{{ $jumlah_mustahik }}"
                                        data-purecounter-duration="1" class="purecounter">{{ $jumlah_mustahik }}</span>
                                    <p><strong>Total Mustahik</strong></p>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-6">
                            <div class="stats-item d-flex">
                                <i class="bi bi-journal-richtext flex-shrink-0"></i>
                                <div>
                                    <span data-purecounter-start="0"
                                        data-purecounter-end="{{ number_format($dana_terkumpul, 0, ',', '.') }}"
                                        data-purecounter-duration="1" class="purecounter">Rp.
                                        {{ number_format($dana_terkumpul, 0, ',', '.') }}</span>
                                    <p><strong>Total Penghimpunan</strong></p>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-6">
                            <div class="stats-item d-flex">
                                <i class="bi bi-journal-richtext flex-shrink-0"></i>
                                <div>
                                    <span data-purecounter-start="0"
                                        data-purecounter-end="{{ number_format($dana_tersalurkan, 0, ',', '.') }}"
                                        data-purecounter-duration="1" class="purecounter">Rp.
                                        {{ number_format($dana_tersalurkan, 0, ',', '.') }}</span>
                                    <p><strong>Total Penyaluran</strong></p>
                                </div>
                            </div>
                        </div><!-- End Stats Item -->

                    </div>

                </div>

            </div>

        </div>
    </section><!-- /Stats Counter Section -->

    <!-- Recent Blog Posts Section -->
    <section id="recent-blog-posts" class="recent-blog-posts section">
        <div class="container section-title position-relative d-flex align-items-center justify-content-between">
            <h3 class="inner-title">Program Baznas</h3>
            <a href="{{ url('/kegiatan') }}">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="container">
            <div class="row gy-5">
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
    <!-- /Recent Blog Posts Section -->

    <!-- Recent Blog Posts Section -->
    <section id="recent-blog-posts" class="recent-blog-posts section light-background">
        <div class="container section-title position-relative d-flex align-items-center justify-content-between">
            <h3 class="inner-title">Artikel</h3>
            <a href="{{ url('/kategori/artikel') }}">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="container">
            <div class="row gy-5">
                @foreach ($artikels as $artikel)
                    <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="{{ route('artikel.show', $artikel->slug) }}">
                            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">
                                <div class="post-img position-relative overflow-hidden">
                                    @if ($artikel->gambar)
                                        <img src="{{ asset('storage/' . $artikel->gambar) }}" class="img-fluid"
                                            alt="{{ $artikel->kategori->name }}">
                                    @else
                                        <img src="{{ URL::asset('dist/img/blog/blog-1.jpg') }}" class="img-fluid"
                                            alt="{{ $artikel->kategori->name }}">
                                    @endif
                                </div>
                                <div class="post-content d-flex flex-column">
                                    <div class="meta d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span class="category">{{ $artikel->kategori->name }}</span>
                                        </div>
                                    </div>
                                    <h3 class="post-title">{{ $artikel->judul }}</h3>
                                    <div class="meta d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span>{{ $artikel->created_at->translatedFormat('d F Y') }}</span>
                                        </div>
                                    </div>
                                    <p>{{ $artikel->kutipan }}</p>
                                    <hr>
                                    <a href="{{ route('artikel.show', $artikel->slug) }}"
                                        class="readmore stretched-link"><span>Detail</span><i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /Recent Blog Posts Section -->

    <!-- Recent Blog Posts Section -->
    <section id="recent-blog-posts" class="recent-blog-posts section">
        <div class="container section-title position-relative d-flex align-items-center justify-content-between">
            <h3 class="inner-title">Cerita Aksi</h3>
            <a href="{{ url('/kategori/cerita-aksi') }}">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="container">
            <div class="row gy-5">
                @foreach ($ceritas as $cerita)
                    <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="{{ route('artikel.show', $cerita->slug) }}">
                            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">
                                <div class="post-img position-relative overflow-hidden">
                                    @if ($cerita->gambar)
                                        <img src="{{ asset('storage/' . $cerita->gambar) }}" class="img-fluid"
                                            alt="{{ $cerita->kategori->name }}">
                                    @else
                                        <img src="{{ URL::asset('dist/img/blog/blog-1.jpg') }}" class="img-fluid"
                                            alt="{{ $cerita->kategori->name }}">
                                    @endif
                                </div>
                                <div class="post-content d-flex flex-column">
                                    <div class="meta d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span class="category">{{ $cerita->kategori->name }}</span>
                                        </div>
                                    </div>
                                    <h3 class="post-title">{{ $cerita->judul }}</h3>
                                    <div class="meta d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span>{{ $cerita->created_at->translatedFormat('d F Y') }}</span>
                                        </div>
                                    </div>
                                    <p>{{ $cerita->kutipan }}</p>
                                    <hr>
                                    <a href="{{ route('artikel.show', $cerita->slug) }}"
                                        class="readmore stretched-link"><span>Detail</span><i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /Recent Blog Posts Section -->
@endsection
