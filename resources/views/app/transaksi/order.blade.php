@php
    require_once app_path() . '/Helpers/helper.php';
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">

        <h3 class="mb-3">Data Penjualan</h3>
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
                    <h3>Data Penjualan</h3>
                    <span class="fs-5">{{ !is_null($tanggal_awal) ? generateDate($tanggal_awal) : generateDate($sekarang) }} s/d {{ !is_null($tanggal_akhir) ? generateDate($tanggal_akhir) : generateDate($sekarang) }}</>
                </div>
               {{-- <div class="mb-4">
                <a href="{{route('transaksi-penjualan.create')}}" class="btn btn-primary">Tambah Transaksi</a>
               </div> --}}
               <table class="table table-borderless table-hover" id="myTable">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        {{-- <th>produk</th> --}}
                        <th class="text-center">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_penjualan as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ generateDate($item->tanggal_faktur->toDateString()) }}</td>
                            <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                            <td>{{ $item->pelanggan->no_telp }}</td>
                            <td>{{ $item->pelanggan->alamat }}</td>
                            {{-- <td>{{ $item->pelanggan->alamat }}</td> --}}
                            <td class="text-center">Rp. {{ number_format($item->total_bayar, '0', ',', '.') }}</td>
                         
                        </tr>
                    @endforeach
                </tbody>
               </table>
            </div>
        </div>
    </div>
@endsection
