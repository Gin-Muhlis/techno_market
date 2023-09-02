<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontak extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama', 'pesan', 'tanggal'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
