<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'harga_jual',
        'tersedia',
        'user_id',
        'produk_id',
        'gambar',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tersedia' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
