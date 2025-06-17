<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Student;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roles = ['admin','siswa','kepsek','parent'];
        if (in_array($user->role, $roles)) {
            return view('profile.' . $user->role, compact('user'));
        } else {
            return abort(403); // Menggunakan abort untuk menampilkan halaman 403
        }
    }

    public function update(Request $request)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
            'unique' => ucwords(':attribute sudah ada !'),
        ];

        $attributes = [
            'username' => ucwords('username'),
            'email' => ucwords('email'),
        ];

        // Dapatkan user saat ini
        $user = Auth::user();

        // Validasi data, dengan pengecualian unik pada email yang sedang diupdate
        $request->validate([
            'username' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id), // Email unik tapi abaikan user yang sedang diupdate
            ],
        ], $messages, $attributes);

        // Cari akun berdasarkan ID user yang sedang login
        $akun = User::find($user->id);

        // Update akun di tabel User jika ada perubahan pada username atau email
        if ($request->username != $akun->username) {
            $akun->username = $request->username;
        }
        if ($request->email != $akun->email) {
            $akun->email = $request->email;
        }

        // Jika password diisi, maka update password
        if (!empty($request->password)) {
            $akun->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $akun->save();

        // Kembalikan respon
        return redirect()->back()->with('success', 'Akun berhasil diperbarui!');

    }
}
