<div class="px-3 px-md-4 px-lg-5 mt-5 mb-5"  data-aos="fade-up" data-aos-delay="10"
data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
data-aos-anchor-placement="top-center">
    <div class="w-100 p-4  rounded rounded-3 contact">
        <h2 class="text-center mb-5">Hubungi Kami</h2>
        <form action="{{ route('contact.sent') }}" method="POST" class="w-100 m-auto">
            @csrf
            <div class="mb-4 d-md-flex align-items-center justify-content-center gap-3">
                <label for="nama" class="p-0 mb-2 mb-md-0">Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-4 d-md-flex align-items-start justify-content-center gap-3">
                <label for="pesan" class="p-0 mb-2 mb-lg-2">Pesan:</label>
                <textarea name="pesan" id="pesan" class="form-control" required></textarea>
            </div>
            <div class="mb-4 d-md-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-contact">Kirim</button>
            </div>
        </form>
    </div>
</div>
