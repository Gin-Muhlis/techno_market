@php
    require_once app_path() . '/Helpers/helper.php';
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">

        <h3 class="mb-3">Laporan Penjualan</h3>
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <label for="tanggalAwal">Tanggal Awal</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="tanggalAwal" name="tanggal_awal" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 text-center">
                            <span class="fw-bold fs-6">s/d</span>
                        </div>
                        <div class="col-md-5">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <label for="tanggalAkhir">Tanggal Akhir</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="tanggalAkhir" name="tanggal_akhir" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
                <div class="w-100 text-center p-4 mt-4 mb-2">
                    <h3>Laporan Penjualan</h3>
                    <span class="fs-5">{{ !is_null($tanggal_awal) ? generateDate($tanggal_awal) : generateDate($sekarang) }} s/d {{ !is_null($tanggal_akhir) ? generateDate($tanggal_akhir) : generateDate($sekarang) }}</>
                </div>
               <div class="mb-4">
                <a href="{{route('export.penjualan')}}" class="btn btn-success">Export Excel</a>
               </div>
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
            </div>
        </div>
    </div>
    <form action="{{ route('export.penjualan') }}" method="get">
    <input type="date" name="tanggal_awal" value="{{ $tanggal_awal }}">
    <input type="date" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
</form>
@endsection
