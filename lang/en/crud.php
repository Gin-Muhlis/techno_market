<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'barang' => [
        'name' => 'Barang',
        'index_title' => 'Daftar Barang',
        'new_title' => 'New Barang',
        'create_title' => 'Tambah Barang',
        'edit_title' => 'Edit Barang',
        'show_title' => 'Show Barang',
        'inputs' => [
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'satuan' => 'Satuan',
            'harga_jual' => 'Harga Jual',
            'tersedia' => 'Tersedia',
            'user_id' => 'User',
            'produk_id' => 'Produk',
            'gambar' => 'Gambar',
        ],
    ],

    'pelanggan' => [
        'name' => 'Pelanggan',
        'index_title' => 'Daftar Pelanggan',
        'new_title' => 'New Pelanggan',
        'create_title' => 'Tambah Pelanggan',
        'edit_title' => 'Edit Pelanggan',
        'show_title' => 'Show Pelanggan',
        'inputs' => [
            'nama_pelanggan' => 'Nama Pelanggan',
            'kode_pelanggan' => 'Kode Pelanggan',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
        ],
    ],

    'detail_penjualan' => [
        'name' => 'Detail Penjualan',
        'index_title' => 'Daftar Detail Penjualan',
        'new_title' => 'New Detail penjualan',
        'create_title' => 'Tambah Detail Penjualan',
        'edit_title' => 'Edit Detail Penjualan',
        'show_title' => 'Show DetailPenjualan',
        'inputs' => [
            'harga_satuan' => 'Harga Satuan',
            'quantity' => 'Quantity',
            'sub_total' => 'Sub Total',
            'penjualan_id' => 'Penjualan',
            'barang_id' => 'Barang',
        ],
    ],

    'ketentuan' => [
        'name' => 'Ketentuan',
        'index_title' => 'Daftar Ketentuan',
        'new_title' => 'New Ketentuan',
        'create_title' => 'Tambah Ketentuan',
        'edit_title' => 'Edit Ketentuan',
        'show_title' => 'Show Ketentuan',
        'inputs' => [
            'nama_ketentuan' => 'Nama Ketentuan',
        ],
    ],

    'kontak' => [
        'name' => 'Kontak',
        'index_title' => 'Daftar Kontak',
        'new_title' => 'New Kontak',
        'create_title' => 'TambahKontak',
        'edit_title' => 'Edit Kontak',
        'show_title' => 'Show Kontak',
        'inputs' => [
            'nama' => 'Nama',
            'pesan' => 'Pesan',
            'tanggal' => 'Tanggal',
        ],
    ],

    'penjualan' => [
        'name' => 'Penjualan',
        'index_title' => 'Daftar Penjualan',
        'new_title' => 'New Penjualan',
        'create_title' => 'Tambah Penjualan',
        'edit_title' => 'Edit Penjualan',
        'show_title' => 'Show Penjualan',
        'inputs' => [
            'no_faktur' => 'No Faktur',
            'tanggal_faktur' => 'Tanggal Faktur',
            'total_bayar' => 'Total Bayar',
            'pelanggan_id' => 'Pelanggan',
            'user_id' => 'User',
        ],
    ],

    'produk' => [
        'name' => 'Produk',
        'index_title' => 'Daftar Produk',
        'new_title' => 'New Produk',
        'create_title' => 'Tambah Produk',
        'edit_title' => 'Edit Produk',
        'show_title' => 'Show Produk',
        'inputs' => [
            'nama_produk' => 'Nama Produk',
        ],
    ],

    'user' => [
        'name' => 'User',
        'index_title' => 'Daftar User',
        'new_title' => 'New User',
        'create_title' => 'TambahUser',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
