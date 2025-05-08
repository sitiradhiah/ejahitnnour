<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    // Jika jadual pekerja berbeza dengan nama model
    protected $table = 'workers';  // Gantikan dengan nama jadual sebenar

    // Tentukan kolum yang boleh diisi
    protected $fillable = [
        'name', 'email', 'phone', 'peranan',
    ];
}
