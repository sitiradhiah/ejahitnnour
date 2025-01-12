<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TempahanController extends Controller
{
    public function senarai()
    {
        // Your logic for the 'senarai' route
        return view('admin.tempahan.senarai');
    }

    public function baru()
    {
        // Your logic for the 'baru' route
    }
}