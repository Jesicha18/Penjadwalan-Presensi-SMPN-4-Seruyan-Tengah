<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalWaka = User::where('role', 'waka')->count();
        $totalKepsek = User::where('role', 'kepsek')->count();
        $totalGuru = User::where('role', 'guru')->count();

        $users = User::latest()->get();

        return view('dashboard.admin', compact(
            'totalUsers', 'totalAdmin', 'totalWaka', 'totalKepsek', 'totalGuru', 'users'
        ));
    }

    // 1. Simpan User Baru
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255', 
            'email'         => 'required|email|unique:users,email',
            'role'          => 'required|in:admin,waka,kepsek,guru',
            'password'      => 'required|min:6',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'is_active' => true, 
        ]);

        return back()->with('success', 'Akun pengguna baru berhasil ditambahkan.');
    }

    // 2. Reset Password User oleh Admin
    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('password123');
        $user->save();

        return back()->with('success', "Password untuk akun {$user->email} berhasil direset menjadi 'password123'.");
    }

    // 3. Toggle Status Aktif/Nonaktif Akun
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        // Asumsi ada kolom 'is_active' (boolean) di tabel users
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Status akun berhasil diperbarui.');
    }
}