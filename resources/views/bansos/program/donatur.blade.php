<p>
    <strong>Nama Program : </strong> {{ $program->title }}
</p>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center" style="width: 40px">No.</th>
            <th>Nama</th>
            <th>Nominal</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($donaturs as $donatur)
            <tr>
                <td class="text-center">{{ $donaturs->firstItem() + $loop->index }}</td>
                <td>{{ $donatur->nama ?? 'Anonim' }}</td>
                <td>Rp {{ number_format($donatur->nominal_donasi, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($donatur->created_at)->locale('id')->translatedFormat('d F Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row align-items-center">
    <div class="col-md-6 align-items-center">
        Menampilkan
        {{ $donaturs->firstItem() }}
        hingga
        {{ $donaturs->lastItem() }}
        dari
        {{ $donaturs->total() }} entri
    </div>
    <div class="col-md-6">
        <div class="pull-right">
            {{ $donaturs->links() }}
        </div>
    </div>
</div>
