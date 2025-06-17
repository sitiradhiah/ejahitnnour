<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'nombor_telefon',
        'alamat',
        'jenis_tempahan',
        'nama_design',
        'tarikh_tempahan',
        'chest_size',
        'waist_size',
        'shoulder_width',
        'sleeve_length',
        'jenis_kain',
        'warna_kain',
        'size',
        'harga_tempahan',
        'additional_notes',
        'status', // Tambah status untuk menandakan sama ada tempahan telah disahkan atau tidak
        'idPelanggan',
        'idPekerja',
    ];

    public function pekerja()
    {
        return $this->belongsTo(User::class, 'idPekerja', 'id');
    }
    // For pelanggan (who made the booking)
    public function user()
    {
        return $this->belongsTo(User::class, 'idPelanggan');
    }
}
