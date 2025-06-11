<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Kedai;
use App\Models\EmailSetting; // if you have this model

class TetapanController extends Controller
{
   public function index()
    {
        // Retrieve data needed by each tab
        $announcement = Announcement::first();
        // $kedai = Kedai::first(); // or ->all() if there are many
         // Retrieve email settings from .env
        $mail_host = env('MAIL_HOST');
        $mail_port = env('MAIL_PORT');
        $mail_username = env('MAIL_USERNAME');
        $mail_password = env('MAIL_PASSWORD');
        $mail_encryption = env('MAIL_ENCRYPTION');

        return view('admin.maklumatsistem.tetapan.index-tetapan', compact(
            'announcement',
            // 'kedai',
            'mail_host',
            'mail_port',
            'mail_username',
            'mail_password',
            'mail_encryption'
        ));
    }
}
