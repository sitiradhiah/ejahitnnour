<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcement = Announcement::first();
        return view('admin.announcement', compact('announcement'));
    }

    public function update(Request $request)
    {
         $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $announcement = Announcement::first() ?? new Announcement();
        $announcement->message = $request->message;
        $announcement->is_active = $request->has('is_active');
        $announcement->save();

        cache()->forget('announcement'); // clear cached data

        return redirect()->back()->with('success', 'Pengumuman Dikemaskini.');
    }

}
