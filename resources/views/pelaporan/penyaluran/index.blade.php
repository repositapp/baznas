@extends('layouts.master')
@section('title')
    Laporan Pengeluaran
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Laporan
        @endslot
        @slot('li_2')
            Laporan Pengeluaran
        @endslot
        @slot('title')
            Laporan Pengeluaran
        @endslot
    @endcomponent

    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <div class="row align-items-center">
                    <div class="col-md-12 align-items-center">
                        <form id="filterForm" class="form-inline mb-3">
                            <div class="form-group">
                                <label for="tgl_awal">Dari: </label>
                                <input type="date" name="tgl_awal" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-left: 15px;">
                                <label for="tgl_akhir">Sampai: </label>
                                <input type="date" name="tgl_akhir" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-left: 15px;">
                                <label>Jenis Zakat:</label>
                                <select name="zakat_id" class="form-control">
                                    <option value="">-- Semua --</option>
                                    {{-- @foreach ($zakat as $id => $label)
                                        <option value="{{ $id }}">{{ $label }}</option>
                                    @endforeach --}}
                                    @foreach ($zakats as $zakat)
                                        <option value="{{ $zakat->id }}">
                                            {{ $zakat->nama_sumbangan }} - {{ $zakat->jenis_benda }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-social btn-sm btn-success" style="margin-left: 15px;"><i
                                    class="fa fa-search"></i>
                                Tampilkan Data</button>

                            <button id="btnCetak" type="button" class="btn btn-social btn-sm btn-primary"
                                style="margin-left: 10px; display: none;">
                                <i class="fa fa-print"></i> Cetak
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <table class="table table-bordered table-striped table-hover" id="pembayaranTable">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Mustahik</th>
                            <th>Jenis Zakat</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">Silakan pilih filter untuk menampilkan data.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <div class="row align-items-center">
                    <div class="col-md-6 align-items-center" id="infoJumlah">
                        Menampilkan 0 hingga 0 dari 0 entri
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right" id="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        let currentPage = 1;

        function loadData(page = 1) {
            let tgl_awal = $('[name="tgl_awal"]').val();
            let tgl_akhir = $('[name="tgl_akhir"]').val();
            let zakat_id = $('[name="zakat_id"]').val();

            $.ajax({
                url: "{{ route('pelaporan.penyaluran.data') }}",
                data: {
                    tgl_awal,
                    tgl_akhir,
                    zakat_id,
                    page
                },
                success: function(response) {
                    const data = response.data;
                    const total = response.total;
                    const per_page = response.per_page;
                    const current = response.current_page;
                    const last = response.last_page;

                    let rows = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            rows += `<tr>
                                <td>${item.kode_penyaluran}</td>
                            <td>${item.tgl_penyaluran}</td>
                            <td>${item.mustahik?.nama || '-'}</td>
                            <td>${item.zakat?.nama_sumbangan || '-'}</td>
                            <td>${parseInt(item.total).toLocaleString('id-ID')}</td>
                            </tr>`;
                        });
                        $('#btnCetak').show();
                    } else {
                        rows =
                            '<tr><td colspan="5" class="text-center">Data Penyaluran Zakat belum Tersedia.</td></tr>';
                        $('#btnCetak').hide();
                    }

                    $('#pembayaranTable tbody').html(rows);
                    $('#infoJumlah').text(
                        `Menampilkan ${(current - 1) * per_page + 1} hingga ${Math.min(current * per_page, total)} dari ${total} entri`
                    );

                    // Pagination
                    let pagination = '<ul class="pagination pagination-sm no-margin">';

                    // Tombol prev
                    if (current > 1) {
                        pagination += `<li><a href="#" class="page-link" data-page="${current - 1}">‹</a></li>`;
                    }

                    let startPage = Math.max(1, current - 2);
                    let endPage = Math.min(last, current + 2);

                    // Awal
                    if (startPage > 1) {
                        pagination += `<li><a href="#" class="page-link" data-page="1">1</a></li>`;
                        if (startPage > 2) {
                            pagination += `<li><span>...</span></li>`;
                        }
                    }

                    // Tengah
                    for (let i = startPage; i <= endPage; i++) {
                        pagination +=
                            `<li class="${i === current ? 'active' : ''}"><a href="#" class="page-link" data-page="${i}">${i}</a></li>`;
                    }

                    // Akhir
                    if (endPage < last) {
                        if (endPage < last - 1) {
                            pagination += `<li><span>...</span></li>`;
                        }
                        pagination += `<li><a href="#" class="page-link" data-page="${last}">${last}</a></li>`;
                    }

                    // Tombol next
                    if (current < last) {
                        pagination += `<li><a href="#" class="page-link" data-page="${current + 1}">›</a></li>`;
                    }

                    pagination += '</ul>';
                    $('#pagination').html(pagination);

                    // Update current page
                    currentPage = current;
                }
            });
        }

        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            loadData(1);
        });

        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            loadData(page);
        });

        $('#btnCetak').on('click', function() {
            const tgl_awal = $('[name="tgl_awal"]').val();
            const tgl_akhir = $('[name="tgl_akhir"]').val();
            const zakat_id = $('[name="zakat_id"]').val();

            let url =
                `{{ route('pelaporan.penyaluran.cetak') }}?tgl_awal=${tgl_awal}&tgl_akhir=${tgl_akhir}&zakat_id=${zakat_id}`;
            window.open(url, '_blank');
        });
    </script>
@endpush
