<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AduanCadangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan', 'tajuk', 'kategori', 'tarikh', 'status', 'message'
    ];
}
