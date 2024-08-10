<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $category = Category::get();
        return view('admin.categories.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => str_replace(' ', '-', strtolower($request->name)),
        ]);

        return redirect()->route('category.index')->with('success', 'Berhasil menambahkan kategori');
    }

    public function edit($category)
    {
        $category = Category::findOrFail($category);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $category)
    {
        $category = Category::findOrFail($category);

        $request->validate([
            'name' => 'required',
        ]);

        $category->name = $request->input('name');
        $category->slug = str_replace(' ', '-', strtolower($request->name));
        $category->save();

        return redirect()->route('category.index')->with('success', 'Berhasil update kategori');
    }

    public function destroy($category)
    {
        $category = Category::findOrFail($category)->delete();
        return redirect()->route('category.index')->with('success', 'Berhasil menghapus kategori');
    }
}
