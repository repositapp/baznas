@extends('layouts.first')
@section('title')
    Rekening
@endsection
@section('content')
    <div class="page-title dark-background" style="background-image: url('{{ URL::asset('dist/img/page-title-bg.jpg') }}');">
        <div class="container position-relative">
            <h1>Rekening</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('index') }}">Beranda</a></li>
                    <li class="current">Rekening</li>
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
                                    <h2 class="title">Rekening</h2>
                                </div>
                                <div class="col-md-3 align-items-center">
                                    <form action="{{ route('rekening.show') }}">
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
                                        <th>Logo Bank</th>
                                        <th>Nama Bank</th>
                                        <th>Nomor Rekening</th>
                                        <th>Pemilik</th>
                                    </tr>
                                </thead>
                                <Tbody>
                                    @forelse ($banks as $bank)
                                        <tr>
                                            <td class="text-center">{{ $banks->firstItem() + $loop->index }}</td>
                                            <td width="200px">
                                                <img src="{{ asset('storage/' . $bank->logo_bank) }}"
                                                    class="img-fluid mb-3 d-block" alt="Logo Bank" width="20%">
                                            </td>
                                            <td>{{ $bank->nama_bank }}</td>
                                            <td>{{ $bank->rekening }}</td>
                                            <td>{{ $bank->pemilik }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                Data akun pembayaran belum Tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </Tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-6">
                                    Menampilkan
                                    {{ $banks->firstItem() }}
                                    hingga
                                    {{ $banks->lastItem() }}
                                    dari
                                    {{ $banks->total() }} entri
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <section id="blog-pagination" class="blog-pagination section">
                                            <div class="d-flex justify-content-end">
                                                {{ $banks->links() }}
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
