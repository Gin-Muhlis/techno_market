<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Order Pesanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('order.make') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="produk_id" id="produk_id">
                    <x-inputs.group class="col-sm-12 mb-3 group-input">
                        <x-inputs.text name="nama_pelanggan" label="Nama Pelanggan"
                            placeholder="Nama" required id="nama_pelanggan"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12 mb-3 group-input">
                        <x-inputs.text name="alamat" label="Alamat" maxlength="200" placeholder="Alamat" required
                            id="alamat"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12 mb-3 group-input">
                        <x-inputs.text name="no_telp" label="No Telepon" maxlength="20" placeholder="No Telelpon" required
                            id="no_telp"></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12 mb-3 group-input">
                        <x-inputs.text name="produk" label="Produk" maxlength="20" placeholder="Produk" required
                            id="produk"></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="col-sm-12 mb-3 group-input">
                        <x-inputs.number name="quantity" label="Quantity" maxlength="20" placeholder="Quantity" required
                            id="quantity"></x-inputs.number>
                    </x-inputs.group>
                    {{-- <x-inputs.group class="col-sm-12 mb-3 group-input">
                      <input type="checkbox" name="terms" id="terms" required>
                     <label for="terms"> Saya telah membaca <a href="">Syarat dan Ketentuan</a></label>
                    </x-inputs.group> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Order</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>