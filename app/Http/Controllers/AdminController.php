<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::get();
        return view('admin.admin.index', compact('admins'));
    }

    public function create()
    {
        $admins = User::get();
        return view('admin.admin.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.index')->with('success', 'Berhasil menambahkan admin');
    }

    public function edit($admin)
    {
        $admin = User::findOrFail($admin);
        return view('admin.admin.edit', compact('admin'));
    }

    public function update(Request $request, $admin)
    {
        $admin = User::findOrFail($admin);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
        ]);

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->input('password'));
        }

        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Berhasil update admin');
    }

    public function destroy($admin)
    {
        $admin = User::findOrFail($admin)->delete();
        return redirect()->route('admin.index')->with('success', 'Berhasil menghapus admin');
    }
}
