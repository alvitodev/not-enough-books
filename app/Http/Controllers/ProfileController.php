<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; // Untuk unique rule saat update
use Illuminate\Support\Facades\Storage; // Added for Storage facade

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile.
     * Dipanggil oleh rute GET /user/edit-profile
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit-profile', [ // View untuk edit profil
            'title' => 'Edit Profile',
            'keyt' => 'profile', // Jika masih relevan
            'user' => $user
        ]);
    }

    /**
     * Update the user's profile information.
     * Dipanggil oleh rute PUT /user/update-profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Unik, kecuali untuk user ini sendiri
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Unik, kecuali untuk user ini sendiri
            ],
            'password' => 'nullable|string|min:6', // Password opsional, jika diisi baru diupdate
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Validasi untuk gambar profil
            // Tambahkan validasi untuk field lain jika ada (phone, dob, location, postal_code, profile_picture)
            // 'phone' => 'nullable|string|max:20',
            // 'dob' => 'nullable|date',
            // 'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update data dasar
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];

        // Update password jika diisi
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']); // Model User sudah ada cast 'hashed'
        }

        // Handle profile picture upload jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan bukan gambar default
            if ($user->image && $user->image !== 'profile_images/default-avatar.png') {
                Storage::disk('public')->delete($user->image);
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    // Method index() yang lama mungkin tidak diperlukan lagi jika edit() mengambil perannya
    // public function index() {
    //     return view('user.edit-profile', [
    //         'title' => 'Edit Profile',
    //         'keyt' => 'profile'
    //     ]);
    // }

    // Method showUser dan showAdmin yang ada di rute sebelumnya
    // perlu didefinisikan jika masih relevan.
    // Contoh:
    // public function showUser() { /* ... */ }
    // public function showAdmin() { /* ... */ }
}