<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katelog extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'warna',
        'saiz',
        'harga',
        'stok',
        'penerangan',
        'gambar',
    ];
}
