<div class="position-relative menu-section mt-5 px-3 px-md-4 px-lg-5">
    <h2 class="title-menu mb-4 text-center"
    data-aos="zoom-in" data-aos-delay="10"
                data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
                data-aos-anchor-placement="top-center">Menu Kita</h2>
  <div class="d-flex align-items-center justify-content-between w-100">
    <span class="makanan-title mb-1" data-aos="fade-right" data-aos-delay="10"
    data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
    data-aos-anchor-placement="top-center">
        Makanan
    </span>
    <span class="makanan-title mb-1" data-aos="fade-left" data-aos-delay="10"
    data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
    data-aos-anchor-placement="top-center">
        Geser untuk selengkapnya
        <i class="fas fa-long-arrow-alt-right"></i>
    </span>
  </div>
    <div class="row mt-3 owl-carousel owl-theme mb-5" id="menu"
   >
       
        @foreach($produkMakanan as $makanan)
        <div class="item d-flex align-items-center justify-content-start gap-3 p-3 rounded"
        data-aos="fade-up" data-aos-delay="10"
        data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
        data-aos-anchor-placement="top-center">
            <img src="{{ \Storage::url($makanan->gambar) }}" class="image" alt="gambar makanan" />
            <div class="detail-makanan w-100">
                <span class=" d-block nama fw-bold mb-3">{{ $makanan->nama_barang }}</span>
                <span class="d-block harga mb-2">Rp. {{ number_format($makanan->harga_jual, '0', ',', '.') }}</span>
                <button class="btn-order rounded"
                data-bs-toggle="modal" data-bs-target="#modal-form" data-barang="{{ $makanan->nama_barang }}">Order Sekarang</button>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex align-items-center justify-content-between w-100">
        <span class="makanan-title mb-1" data-aos="fade-right" data-aos-delay="10"
        data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
        data-aos-anchor-placement="top-center">
            Minuman
        </span>
        <span class="makanan-title mb-1" data-aos="fade-left" data-aos-delay="10"
        data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
        data-aos-anchor-placement="top-center">
            Geser untuk selengkapnya
            <i class="fas fa-long-arrow-alt-right"></i>
        </span>
      </div>
    <div class="row mt-3 owl-carousel owl-theme mb-5" id="minuman">
        @foreach($produkMinuman as $makanan)
        <div class="item d-flex align-items-center justify-content-start gap-3 p-3 rounded"
        data-aos="fade-up" data-aos-delay="10"
        data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
        data-aos-anchor-placement="top-center">
            <img src="{{ \Storage::url($makanan->gambar) }}" class="image" alt="gambar makanan" />
            <div class="detail-makanan w-100">
                <span class=" d-block nama fw-bold mb-3">{{ $makanan->nama_barang }}</span>
                <span class="d-block harga mb-2">Rp. {{ number_format($makanan->harga_jual, '0', ',', '.') }}</span>
                <button class="btn-order rounded"
                data-bs-toggle="modal" data-bs-target="#modal-form" data-barang="{{ $makanan->nama_barang }}">Order Sekarang</button>
            </div>
        </div>
        @endforeach
    </div>

</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel();
        });
        $('#menu').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
        $('#minuman').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            let objectStr1 = JSON.stringify(@json($produkMakanan));
            let dataObject1 = JSON.parse(objectStr1)
            let objectStr2 = JSON.stringify(@json($produkMinuman));
            let dataObject2 = JSON.parse(objectStr2)
            
            let dataProduk = [...dataObject1, ...dataObject2];
            $(".btn-order").on("click", function(event) {
                let btn = event.target

                let namaAttr = $(btn).data("barang")

                let produk = dataProduk.find(item => item.nama_barang == namaAttr)
                
                
                $("#produk").val(produk.nama_barang)
                $("#produk_id").val(produk.id)
            })
        })
    </script>
@endpush
