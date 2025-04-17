<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AduanCadangan extends Model
{
    use HasFactory;

    // Tell Laravel the correct table name
    protected $table = 'aduan_cadangan';

    protected $fillable = [
        'nama_pelanggan', 'tajuk', 'kategori', 'tarikh', 'status', 'message'
    ];

    protected $casts = [
        'tarikh' => 'date',
    ];
}
