<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display all categories
    public function index()
{
    $categories = Category::all();
    return view('admin.katelog.kategori', compact('categories'));
}

public function store(Request $request)
{
    $request->validate(['name' => 'required|string|max:255']);
    Category::create(['name' => $request->name]);
    return redirect()->route('kategori.index');
}

public function edit($id)
{
    $category = Category::findOrFail($id);
    return response()->json($category);
}

public function update(Request $request, $id)
{
    $request->validate(['name' => 'required|string|max:255']);
    $category = Category::findOrFail($id);
    $category->update(['name' => $request->name]);
    return redirect()->route('kategori.index');
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();
    return redirect()->route('kategori.index');
}

}

