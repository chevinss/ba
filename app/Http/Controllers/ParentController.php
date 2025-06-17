<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Services\SiswaServices;
use Illuminate\Validation\Rule;
use App\Services\ParentServices;

class ParentController extends Controller
{
    // CRUD Parent
    public function index()
    {
        $parent = User::where('role','parent')->whereHas('parents')->get();
        return view('parent.index',compact('parent'));
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
            'uuid' => ucwords('NIK'),
            'nama' => ucwords('nama'),
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
            'uuid' => [
                'required',
                Rule::unique('parents')->ignore($userId, 'user_id'), // Nisn unik tapi abaikan user yang sedang diupdate
            ],
            'nama' => 'required',
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
                'role' => 'parent',
            ]
        );

        // Simpan atau update data siswa
        $parent = Parents::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'uuid' => $request->uuid,
                'nama' => $request->nama,
            ]
        );

        // Berikan feedback sukses
        if ($user->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Berhasil Menambah Data Orang Tua');
        } else {
            return redirect()->back()->with('success', 'Berhasil Mengubah Data Orang Tua');
        }
    }

    public function detail($id)
    {
        $parent = Parents::find($id);
        $siswa['list'] = SiswaServices::list();
        $siswa['parent'] = ParentServices::siswa($parent->id);
        return view('parent.detail', compact('parent','siswa'));
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Orang Tua');
    }

    public function addStudent(Request $request, $id)
    {
        $siswa = Student::find($request->siswa_id);
        if ($siswa->parent_id == $id || $siswa->parent_id != null) {
            # code...
            return redirect()->back()->with('error','Tidak Dapat Menambahkan Siswa');
        }
        $siswa->parent_id = $id;
        $siswa->save();
        return redirect()->back()->with('success','Berhasil Menambahkan Siswa');

    }

    public function removeStudent(Request $request, $id)
    {
        $siswa = Student::find($request->siswa_id);
        $siswa->parent_id = null;
        $siswa->save();
        return redirect()->back()->with('success','Berhasil Menghapus Siswa');
    }

    // Read Data Siswa Yang Dimiliki Parent
    public function detailSiswa($id)
    {
        $data = ParentServices::detailSiswa($id);
        $pengaduan['total'] = Pengaduan::where('student_id', $id)->count();
        $pengaduan['s'] = Pengaduan::where('student_id', $id)->where('status','s')->count();
        $pengaduan['p'] = Pengaduan::where('student_id', $id)->where('status','p')->count();
        $pengaduan['f'] = Pengaduan::where('student_id', $id)->where('status','f')->count();
        return view('parent.detailsiswa',compact('data','pengaduan'));
    }
}
