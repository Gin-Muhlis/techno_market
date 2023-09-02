@php $editing = isset($kontak) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nama"
            label="Nama"
            :value="old('nama', ($editing ? $kontak->nama : ''))"
            maxlength="255"
            placeholder="Nama"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="pesan" label="Pesan" maxlength="255" required
            >{{ old('pesan', ($editing ? $kontak->pesan : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="tanggal"
            label="Tanggal"
            value="{{ old('tanggal', ($editing ? optional($kontak->tanggal)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
