@php $editing = isset($barang) @endphp


<div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="method">

                    </div>
                    <div class="row">
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text name="kode_barang" label="Kode Barang" maxlength="50"
                                placeholder="Kode Barang" required id="kode_barang"></x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text name="nama_barang" label="Nama Barang" maxlength="100"
                                placeholder="Nama Barang" required id="nama_barang"></x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text name="satuan" label="Satuan" maxlength="10" placeholder="Satuan" required
                                id="satuan"></x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.number name="harga_jual" label="Harga Jual" step="0.01"
                                placeholder="Harga Jual" required id="harga_jual"></x-inputs.number>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.select name="tersedia" label="Ketersediaan" required id="tersedia">
                                <option disabled selected value="empty">Silahkan Pilih Ketersediaan</option>
                                <option value="1">Tersedia</option>
                                <option value="0">Tidak Tersedia</option>
                            </x-inputs.select>
                        </x-inputs.group>



                        <x-inputs.group class="col-sm-12">
                            <x-inputs.select name="produk_id" label="Produk" required id="produk">

                                <option disabled selected value="empty">Silahkan Pilih Produk</option>
                                @foreach ($produks as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </x-inputs.select>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <div x-data="imageViewer('{{ $editing && $barang->gambar ? \Storage::url($barang->gambar) : '' }}')">
                                <x-inputs.partials.label name="gambar" label="Gambar"></x-inputs.partials.label><br />

                                <!-- Show the image -->
                                <template x-if="imageUrl">
                                    <img :src="imageUrl" class="object-cover rounded border border-gray-200"
                                        style="width: 100px; height: 100px;" />
                                </template>

                                <!-- Show the gray box when image is not available -->
                                <template x-if="!imageUrl">
                                    <div class="border rounded border-gray-200 bg-gray-100"
                                        style="width: 100px; height: 100px;"></div>
                                </template>

                                <div class="mt-2">
                                    <input type="file" name="gambar" id="gambar" @change="fileChosen" />
                                </div>
                                @error('gambar')
                                    @include('components.inputs.partials.error')
                                @enderror
                            </div>
                        </x-inputs.group>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
