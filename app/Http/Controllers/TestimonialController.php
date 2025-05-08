<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    // TestimonialController.php
    public function index()
    {
        $testimonials = Testimonial::all();  // Ambil semua testimonial
        return view('admin.maklumatsistem.testimonial', compact('testimonials'));  // Kembalikan kepada view
    }

    // Halaman untuk mengedit testimonial
    public function edit($id)
    {
        // Ambil testimonial berdasarkan ID
        $testimonial = Testimonial::findOrFail($id);  

        // Paparkan borang untuk mengedit testimonial
        return view('admin.maklumatsistem.testimonial', compact('testimonial'));
    }

    // Proses kemaskini testimonial
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'feedback' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi gambar
        ]);

        $testimonial = Testimonial::findOrFail($id);

        // Jika ada gambar yang di-upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $testimonial->image = basename($imagePath);  // Simpan nama fail gambar sahaja
        }

        $testimonial->update([
            'name' => $request->name,
            'feedback' => $request->feedback,
            'image' => $testimonial->image ?? $testimonial->image, // Pastikan jika tiada gambar, simpan nilai lama
        ]);

        return redirect()->route('testimonial.index')->with('success', 'Testimonial berjaya dikemaskini.');
    }
}
