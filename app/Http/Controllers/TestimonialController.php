<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    // Papar semua testimonial
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.maklumatsistem.testimonial', compact('testimonials'));
    }

    // Papar borang tambah (jika nak asingkan modal)
    public function create()
    {
        return view('admin.maklumatsistem.testimonial_add');
    }

    // Simpan testimonial baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'feedback' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['name', 'feedback']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $data['image'] = basename($path);
        }

        Testimonial::create($data);

        return redirect()->route('testimonial.index')->with('success', 'Testimonial berjaya ditambah.');
    }

    // Papar borang edit testimonial
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.maklumatsistem.testimonial_edit', compact('testimonial'));
    }

    // Kemaskini testimonial sedia ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'feedback' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $testimonial->image = basename($imagePath);
        }

        $testimonial->update([
            'name' => $request->name,
            'feedback' => $request->feedback,
            'image' => $testimonial->image ?? $testimonial->image,
        ]);

        return redirect()->route('testimonial.index')->with('success', 'Testimonial berjaya dikemaskini.');
    }

    // Padam testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('testimonial.index')->with('success', 'Testimonial berjaya dipadam.');
    }
}
