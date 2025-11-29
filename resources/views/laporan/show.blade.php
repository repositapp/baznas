@extends('layouts.first')
@section('title')
    Laporan
@endsection
@section('content')
    <div class="page-title dark-background" style="background-image: url('{{ URL::asset('dist/img/page-title-bg.jpg') }}');">
        <div class="container position-relative">
            <h1>Laporan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="current">Laporan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <article class="article" data-aos="fade-right" data-aos-delay="100">
                        <div class="content">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <h2 class="title">Laporan</h2>
                                </div>
                                <div class="col-md-3 align-items-center">
                                    <form action="{{ route('laporan.show') }}">
                                        <div class="input-group mb-4">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Search..." aria-label="Recipient's username"
                                                aria-describedby="button-addon2" value="{{ request('search') }}">
                                            <button class="btn btn-default" type="submit"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 40px">No.</th>
                                        <th>Nama Dokumen</th>
                                        <th style="width: 150px">Ekstensi</th>
                                        <th style="width: 150px">Ukuran</th>
                                        <th style="width: 150px">Download Sebanyak</th>
                                        <th class="text-center" style="width: 150px">Download</th>
                                    </tr>
                                </thead>
                                <Tbody>
                                    @forelse ($laporans as $laporan)
                                        <tr>
                                            <td class="text-center">{{ $laporans->firstItem() + $loop->index }}</td>
                                            <td>{{ $laporan->nama_dokumen }}</td>
                                            <td>.{{ $laporan->ekstensi }}</td>
                                            <td>{{ $laporan->ukuran }}Kb</td>
                                            <td>{{ $laporan->download ?? 0 }} Kali</td>
                                            <td class="text-center">
                                                <div class="btn-group d-flex">
                                                    <a href="{{ route('laporan.download', $laporan->id) }}"
                                                        class="btn btn-success btn-sm" target="_blank"
                                                        style="color: #ffffff"><i class="fa fa-download"></i> Download</a>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                Data dokumen belum Tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </Tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-6">
                                    Menampilkan
                                    {{ $laporans->firstItem() }}
                                    hingga
                                    {{ $laporans->lastItem() }}
                                    dari
                                    {{ $laporans->total() }} entri
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <section id="blog-pagination" class="blog-pagination section">
                                            <div class="d-flex justify-content-end">
                                                {{ $laporans->links() }}
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </div>
        </div>
    </div>
@endsection
