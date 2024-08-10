<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IklanController extends Controller
{
    public function index()
    {
        $iklan = Iklan::all();
        return view('admin.iklan.index', compact('iklan'));
    }

    public function create()
    {
        return view('admin.iklan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('iklan', 'public');
        }

        Iklan::create([
            'image' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function edit(Iklan $iklan)
    {
        return view('admin.iklan.edit', compact('iklan'));
    }

    public function update(Request $request, Iklan $iklan)
    {
        $request->validate([
            'image' => 'nullable|image',
            'link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($iklan->image && Storage::exists($iklan->image)) {
                Storage::delete($iklan->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('iklan', 'public');
            $iklan->image = $imagePath;
        }

        $iklan->link = $request->link;
        $iklan->save();

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil diupdate.');
    }

    public function destroy(Iklan $iklan)
    {
        if ($iklan->image && Storage::exists($iklan->image)) {
            Storage::delete($iklan->image);
        }

        $iklan->delete();

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil dihapus.');
    }
}
