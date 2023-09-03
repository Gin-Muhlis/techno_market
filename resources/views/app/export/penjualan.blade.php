@php
    require_once app_path() . '/Helpers/helper.php';
@endphp

<table class="table table-striped table-hover">
    <thead>
        <tr class="bg-primary text-white">
            <th class="text-center">Tanggal</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">QTY</th>
            <th class="text-center">Omset</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $item)
            <tr>
                <td class="text-center">{{ generateDate($item['tanggal']->toDateString()) }}</td>
                <td class="text-center">
                    <span class="badge bg-secondary">{{ $item['kode'] }}</span>
                </td>
                <td class="text-center">{{ $item['nama'] }}</td>
                <td class="text-center">{{ $item['qty'] }}</td>
                <td class="text-center">Rp. {{ number_format($item['omset'], '0', ',', '.') }}</td>
            </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-center">Total</td>
            <td class="text-center">Rp. {{ number_format($total_omset, '0', ',', '.') }}</td>
        </tr>
    </tfoot>
</table>
