@extends('layouts.first')
@section('title')
    Unit Pengumpulan Zakat
@endsection
@section('content')
    <div class="page-title dark-background" style="background-image: url('{{ URL::asset('dist/img/page-title-bg.jpg') }}');">
        <div class="container position-relative">
            <h1>Unit Pengumpulan Zakat</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="current">Unit Pengumpulan Zakat</li>
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
                                    <h2 class="title">Unit Pengumpulan Zakat</h2>
                                </div>
                                <div class="col-md-3 align-items-center">
                                    <form action="{{ route('upz.show') }}">
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
                                        <th>Nama UPZ</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <Tbody>
                                    @forelse ($upzs as $upz)
                                        <tr>
                                            <td class="text-center">{{ $upzs->firstItem() + $loop->index }}</td>
                                            <td>{{ $upz->nama_upz }}</td>
                                            <td>{{ $upz->alamat }}</td>
                                            <td>{{ $upz->telepon }}</td>
                                            <td>{{ $upz->email }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                Data UPZ belum Tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </Tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-6">
                                    Menampilkan
                                    {{ $upzs->firstItem() }}
                                    hingga
                                    {{ $upzs->lastItem() }}
                                    dari
                                    {{ $upzs->total() }} entri
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <section id="blog-pagination" class="blog-pagination section">
                                            <div class="d-flex justify-content-end">
                                                {{ $upzs->links() }}
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
