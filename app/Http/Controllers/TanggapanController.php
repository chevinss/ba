<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    // Mengubah Semua Status Pengaduan
    public function proses($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        $pengaduan->status = 'p';
        $pengaduan->save();

        return redirect()->back()->with('success','Berhasil Mengubah Status');
    }
    public function selesai($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        $pengaduan->status = 'f';
        $pengaduan->save();

        return redirect()->back()->with('success','Berhasil Mengubah Status');
    }

    public function store($id, Request $request)
    {
        // Membuat Validasi
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
        ];

        $attributes = [
            'tanggal' => ucwords('Tanggal Tanggapan'),
            'tanggapan' => ucwords('isi tanggapan'),
        ];

        $request->validate([
            'tanggal' => 'required',
            'tanggapan' => 'required',
        ], $messages, $attributes);

        Tanggapan::updateOrCreate(
            [
                'id' => $request->id,
                'pengaduan_id' => $id,
            ],
            [
                'tanggal' => $request->tanggal,
                'isi_tanggapan' => $request->tanggapan,
            ]
        );

        return redirect()->back()->with('success','Berhasil Memberikan Tanggapan');
    }
}
