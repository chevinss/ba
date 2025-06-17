<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\SiswaServices;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = SiswaServices::list();
        // return $siswa;
        return view('siswa.index',compact('siswa'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
            'unique' => ucwords(':attribute sudah ada !'),
        ];

        $attributes = [
            'username' => ucwords('username'),
            'email' => ucwords('email'),
            'password' => ucwords('password'),
            'nisn' => ucwords('nisn'),
            'nama' => ucwords('nama'),
            'kelas' => ucwords('kelas'),
            'jurusan' => ucwords('jurusan'),
        ];

        // Dapatkan userId dari request
        $userId = $request->id;

        // Validasi data
        $request->validate([
            'username' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => $userId ? 'nullable' : 'required', // Password tidak wajib saat update
            'nisn' => [
                'required',
                Rule::unique('students')->ignore($userId, 'user_id'), // Nisn unik tapi abaikan user yang sedang diupdate
            ],
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ], $messages, $attributes);

        // Simpan atau update data user
        $user = User::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : User::find($userId)->password,
                'role' => 'siswa',
            ]
        );

        // Simpan atau update data siswa
        $siswa = Student::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'nisn' => $request->nisn,
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
            ]
        );

        // Berikan feedback sukses
        if ($user->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Berhasil Menambah Data Siswa');
        } else {
            return redirect()->back()->with('success', 'Berhasil Mengubah Data Siswa');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Siswa');
    }

}
