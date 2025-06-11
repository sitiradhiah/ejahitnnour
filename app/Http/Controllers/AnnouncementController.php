<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // public function index()
    // {
    //     $announcement = Announcement::first();
    //     return view('admin.maklumatsistem.tetapan.index-tetapan', compact('announcement'));
    // }

    public function update(Request $request)
    {
         $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $announcement = Announcement::first(); // or create new if not exist
        if (!$announcement) {
            $announcement = new Announcement();
        }

        $announcement->message = $request->message;
        $announcement->is_active = $request->has('is_active');
        $announcement->save();

        return redirect()->back()
            ->with('success', 'Pengumuman telah berjaya di kemasini')
            ->with('active_tab', $request->input('active_tab'))
            ->withErrors($request->getSession()->get('errors'));

    }

}
