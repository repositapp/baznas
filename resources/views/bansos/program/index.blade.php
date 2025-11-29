@extends('layouts.master')
@section('title')
    Program
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Bantuan Sosial
        @endslot
        @slot('li_2')
            Program
        @endslot
        @slot('title')
            Program
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        <form action="{{ route('program.index') }}">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <input type="text" name="search" class="form-control pull-right" placeholder="Search..."
                                    value="{{ request('search') }}">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('program.create') }}" class="btn btn-social btn-sm btn-success">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px">No.</th>
                            <th>Nama Program</th>
                            <th>Durasi</th>
                            <th>Target</th>
                            <th>Donatur</th>
                            <th>Terkumpul</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <Tbody>
                        @forelse ($programs as $program)
                            <tr>
                                <td class="text-center">{{ $programs->firstItem() + $loop->index }}</td>
                                <td>{{ $program->title }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($program->range_start)->locale('id')->translatedFormat('d F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($program->range_end)->locale('id')->translatedFormat('d F Y') }}
                                    ({{ $program->durasi }} hari)
                                </td>
                                <td>Rp {{ number_format($program->jumlah_donasi, 0, ',', '.') }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn-donatur" data-id="{{ $program->id }}">
                                        {{ $program->jumlah_donatur }} orang
                                    </a>
                                </td>
                                <td style="width: 15%">
                                    <div class="clearfix">
                                        <small
                                            class="pull-left">Rp.{{ number_format($program->jumlahDana, 0, ',', '.') }}</small>
                                        <small class="pull-right">{{ $program->persen }}%</small>
                                    </div>
                                    <div class="progress xs">
                                        <div class="progress-bar progress-bar-success" role="progressbar"
                                            style="width: {{ $program->persen }}%">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($program->status == 0)
                                        <span class="label label-danger">Tidak Aktif</span>
                                    @elseif ($program->status == 1)
                                        <span class="label label-info">Pengumpulan</span>
                                    @elseif ($program->status == 2)
                                        <span class="label label-success">Selesai</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group d-flex">
                                        <a href="{{ route('program.edit', $program->id) }}"
                                            class="btn btn-default btn-sm text-green"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('program.destroy', $program->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-default btn-sm text-red"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    Program bantuan sosial belum Tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </Tbody>
                </table>
            </div>
            <!-- /.Modal-Daftar-Donatur -->
            <div class="modal fade" id="modal-donatur" tabindex="-1" role="dialog" aria-labelledby="modalDonaturLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-green">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close"><span>&times;</span></button>
                            <h4 class="modal-title">Daftar Donatur</h4>
                        </div>
                        <div class="modal-body">
                            <div id="donatur-content">Memuat data...</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center">
                        Menampilkan
                        {{ $programs->firstItem() }}
                        hingga
                        {{ $programs->lastItem() }}
                        dari
                        {{ $programs->total() }} entri
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            {{ $programs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            // Tampilkan modal & load data donatur
            $('.btn-donatur').on('click', function() {
                var programId = $(this).data('id');
                $('#modal-donatur').modal('show');
                loadDonatur(programId);
            });

            // Handle pagination AJAX
            $(document).on('click', '#donatur-content .pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                fetchDonaturByUrl(url);
            });

            function loadDonatur(programId) {
                $.get('/panel/program/donatur/' + programId, function(data) {
                    $('#donatur-content').html(data);
                });
            }

            function fetchDonaturByUrl(url) {
                $.get(url, function(data) {
                    $('#donatur-content').html(data);
                });
            }
        });
    </script>
@endpush
