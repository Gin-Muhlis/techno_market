@extends('layouts.app')

@push('styles')
    <style>
        .icon {
            width: 40px;
            height: 40px;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            cursor: pointer
        }

        .text {
            height: 40px;
            padding-left: 8px;
            border: 1px solid rgba(0, 0, 0, .2);
            color: #08080850;

            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .text span {
            line-height: 40px;
        }

        .button-transaksi {
            width: 100%;
            padding-block: 8px;
        }

        .btn-qty,
        .btn-delete {
            cursor: pointer
        }
    </style>
@endpush
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4>Pembelian Barang/ Stok Opname</h4>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table w-100">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">QTY</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-data-barang">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 bg-successs">
                        <div class="card">
                            <div class="card-header bg-primary text-white d-flex align-items-center">
                                <h5>Detail</h5>
                            </div>
                            <div class="card-body">
                                <label for="form-label">Pilih produk</label>
                                <div class="d-flex align-iitems-center justify-content-start w-100 mb-3">
                                    <div class="icon d-flex align-items-center justify-content-center bg-primary"
                                        data-bs-toggle="modal" data-bs-target="#data-barang-modal">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="text w-100">
                                        <span>Cari Barang</span>
                                    </div>
                                </div>
                                <label for="form-label">Pilih Pelanggan</label>
                                <div class="d-flex align-iitems-center justify-content-start w-100 mb-3">
                                    <div class="icon d-flex align-items-center justify-content-center bg-primary"
                                        data-bs-toggle="modal" data-bs-target="#data-pelanggan-modal">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="text w-100 text-pelanggan">
                                        <span>Cari Pelanggan</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between my-3">
                                    <span>Total</span>
                                    <span id="total-transaksi">Rp. 0</span>
                                </div>
                                <button class="btn w-100 btn-primary text-white rounded btn-tambah-transaksi">
                                    Tambah Transaksi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('app.transaksi.data')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const objectString = JSON.stringify(@json($barang));
            const dataBarang = JSON.parse(objectString)
            const dataTransaksi = {
                totalTransaksi: 0,
                pelanggan: null,
                barang: []
            };

            let choicedBarang = []
            let id;

            $(".btn-plus-barang").on("click", (event) => {
                const btn = event.target

                id = $(btn).data("id")

                let barang = dataBarang.find(barang => barang.id == id)

                if (choicedBarang.find(item => item.barang.id == id)) {
                    let alreadyBarang = choicedBarang.find(item => item.barang.id == id)

                    alreadyBarang.qty += 1
                    alreadyBarang.subTotal = alreadyBarang.qty * alreadyBarang.barang.harga_jual
                } else {
                    let dataChoiced = {
                        qty: 1,
                        barang: barang,
                        subTotal: barang.harga_jual
                    }
                    choicedBarang.push(dataChoiced)
                }

                showDataBarang()

                $("#data-barang-modal").modal("hide")

                runQuantity()

            })

            function runQuantity() {
                $(".colomn-qty").on("click", (event) => {
                    let target = event.target

                    let idColomn

                    if ($(target).hasClass("min-qty")) {
                        idColomn = $(target).data("id")
                        subtractQuantity(idColomn, target)
                    }

                    if ($(target).hasClass("plus-qty")) {
                        idColomn = $(target).data("id")
                        plusQuantity(idColomn)
                    }
                })

                return true
            }


            function subtractQuantity(id, btn) {
                let dataChoiced = choicedBarang.find(item => item.barang.id == id)

                let quantity = dataChoiced.qty

                quantity -= 1

                dataChoiced.qty = quantity
                dataChoiced.subTotal = quantity * dataChoiced.barang.harga_jual

                if (quantity <= 1) {
                    $(btn).addClass("d-none")
                    showDataBarang()
                    runQuantity()
                    return
                }

                showDataBarang()
                runQuantity()
                return true
            }

            function plusQuantity(id) {
                let dataChoiced = choicedBarang.find(item => item.barang.id == id)

                let quantity = dataChoiced.qty

                quantity += 1

                dataChoiced.qty = quantity
                dataChoiced.subTotal = quantity * dataChoiced.barang.harga_jual

                showDataBarang()

                runQuantity()

                return true
            }

            function deleteBarang() {
                $(".btn-delete").on("click", (event) => {
                    let target = event.target

                    if ($(target).hasClass("btn-delete")) {
                        let id = $(target).data("id")

                        choicedBarang = choicedBarang.filter(item => item.barang.id !== id)

                        showDataBarang()
                    }
                })
            }

            function showDataBarang() {

                let markup = ``;
                let totalTransaksi = 0;
                choicedBarang.forEach(item => {
                    totalTransaksi += item.subTotal
                    markup += `<tr>
                        <td>${item.barang.kode_barang}</td>
                        <td>${item.barang.nama_barang}</td>
                        <td class="text-center">${item.barang.harga_jual}</td>
                        <td class="d-flex align-items-start justify-content-center gap-3 colomn-qty">
                            <span class="min-qty btn-qty fw-bold text-warning fs-6 ${item.qty <= 1 ? "d-none" : ""}" data-id="${item.barang.id}">-</span>
                            <span>${item.qty}</span>
                            <span class="plus-qty btn-qty fw-bold text-primary fs-6" data-id="${item.barang.id}">+</span>
                        </td>
                        <td class="text-center">${item.subTotal}</td>
                        <td class="text-center" >
                            <i class="fas fa-trash-alt text-danger fs-6 cursor-pointer btn-delete" data-id="${item.barang.id}"></i>
                        </td>
                        </tr>`
                })

                dataTransaksi.totalTransaksi = totalTransaksi

                let totalTransaksiFormat = Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                }).format(totalTransaksi);

                $("#table-data-barang").html(markup)
                $("#total-transaksi").text(totalTransaksiFormat)

                deleteBarang()
            }

            // PELANGGAN
            const objectStringPelanggan = JSON.stringify(@json($pelanggan));
            const dataPelanggan = JSON.parse(objectStringPelanggan)
            let choicedPelanggan = dataPelanggan.find(item => item.nama_pelanggan == "Pelanggan Umum")

            $(".text-pelanggan").html(`<span style="color: #080808;">${choicedPelanggan.nama_pelanggan}</span>`)

            $(".btn-plus-pelanggan").on("click", (event) => {
                const btn = event.target

                let id = $(btn).data("id")

                choicedPelanggan = dataPelanggan.find(item => item.id === id)

                $(".text-pelanggan").html(
                    `<span style="color: #080808;">${choicedPelanggan.nama_pelanggan}</span>`)

                $("#data-pelanggan-modal").modal("hide")
            })

            $(".btn-tambah-transaksi").on("click", (event) => {
                dataTransaksi.pelanggan = choicedPelanggan.id
                dataTransaksi.barang = choicedBarang

                if (dataTransaksi.barang.length < 1) {
                    Swal.fire({
                        text: `Silahkan Pilih Barang Terlebih Dahulu`,
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                    }).then(result => {
                        if (result.isConfirmed)
                            Swal.close()
                    })
                    return
                }

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                })

                $.ajax({
                    url: `{{ url('transaksi-penjualan') }}`,
                    method: 'POST',
                    data: dataTransaksi,
                    success: successTransaksi,
                    error: errorTransaksi
                })


            })

            function successTransaksi(response) {
                choicedBarang.length = 0

                showDataBarang()
                $(".text-pelanggan").html(
                    `<span>Cari Pelanggan</span>`)

                Swal.fire({
                    text: response.message,
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                }).then(result => {
                    if (result.isConfirmed)
                        Swal.close()
                })

                return true
            }

            function errorTransaksi(response) {
                const result = response.responseJSON

                choicedBarang.length = 0
                showDataBarang()
                
                Swal.fire({
                    text: result.message,
                    icon: "warning",
                    confirmButtonColor: "#3085d6",
                }).then(result => {
                    if (result.isConfirmed)
                        Swal.close()
                })

                return true
            }
        })
    </script>
@endpush
