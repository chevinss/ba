<?php

namespace App\Http\Controllers;

use Auth;
use Excel;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PengaduanExport;
use App\Services\PengaduanServices;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;


class PengaduanController extends Controller
{
    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        // Ambil Data User Terlebih Dahulu
        $user = Auth::user()->student->id;

        // Membuat Validasi
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
        ];

        $attributes = [
            'tanggal' => ucwords('Tanggal Pengaduan'),
            'laporan' => ucwords('isi laporan'),
            'files' => ucwords('dokumentasi'),
            'tipe' => ucwords('Tipe Dokumentasi'),
        ];

        $request->validate([
            'tanggal' => 'required',
            'laporan' => 'required',
            'tipe' => 'required',
            'files' => 'required',
        ], $messages, $attributes);

        $ext = $request->file('files')->getClientOriginalExtension();
        // CEK dokumentasi
        $file = $request->file('files');
        switch ($request->tipe) {
            case 'audio':
                # code...
                $path = 'pengaduan/audio/'. md5(date('dmyhis')) . '.'. $ext;
                $file->move(public_path('/pengaduan/audio'), $path);
                break;
            case 'video':
                # code...
                $path = 'pengaduan/video/'. md5(date('dmyhis')) . '.'. $ext;
                $file->move(public_path('/pengaduan/video'), $path);
                break;
            case 'photo':
                # code...
                $path = 'pengaduan/photo/'. md5(date('dmyhis')) . '.jpg';
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($request->file('files'));
                $encoded = $image->toJpeg(50)->save($path);
                break;

            default:
                # code...
                break;
        }
        // Proses Simpan Data
        Pengaduan::create([
            'student_id' => $user,
            'tanggal' => $request->tanggal,
            'isi_laporan' => $request->laporan,
            'type' => $request->tipe,
            'path' => $path,
            'status' => 's',
        ]);

        return redirect()->route('siswa.dashboard')->with('success','Berhasil Membuat Pengaduan');
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        return view('pengaduan.edit', compact('pengaduan'));

    }
    public function detail($id)
    {
        if (Auth::user()->role == 'parent') {
            # code...
            $isParent = true;
        }else {
            $isParent = false;
        }
        // $pengaduan = Pengaduan::where('id', $id)->first();
        $pengaduan = PengaduanServices::detail($id);
        return view('pengaduan.detail',compact('pengaduan','isParent'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
        ];

        $attributes = [
            'tanggal' => ucwords('Tanggal Pengaduan'),
            'laporan' => ucwords('isi laporan'),
            'gambar' => ucwords('Dokumentasi Pengaduan'),
        ];

        $request->validate([
            'tanggal' => 'required',
            'laporan' => 'required',

        ], $messages, $attributes);


        $pengaduan = Pengaduan::where('id', $id)->first();
        // handling gambar
        if ($request->file('files')) {
            # code...
            if (file_exists($pengaduan->path)) {
                # code...
                unlink($pengaduan->path);
            }
            switch ($request->tipe) {
                case 'audio':
                    # code...
                    $path = 'pengaduan/audio/'. md5(date('dmyhis')) . '.'. $ext;
                    $file->move(public_path('/pengaduan/audio'), $path);
                    break;
                case 'video':
                    # code...
                    $path = 'pengaduan/video/'. md5(date('dmyhis')) . '.'. $ext;
                    $file->move(public_path('/pengaduan/video'), $path);
                    break;
                case 'photo':
                    # code...
                    $path = 'pengaduan/photo/'. md5(date('dmyhis')) . '.jpg';
                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read($request->file('files'));
                    $encoded = $image->toJpeg(50)->save($path);
                    break;

                default:
                    # code...
                    break;
            }
            $pengaduan->path = $path;
        }

        $pengaduan->tanggal = $request->tanggal;
        $pengaduan->isi_laporan = $request->laporan;
        $pengaduan->type = $request->tipe;
        $pengaduan->save();

        return redirect()->route('siswa.dashboard')->with('success','Berhasil Mengubah Pengaduan');

    }

    public function delete($id)
    {
        $pengaduan = Pengaduan::where('id',$id)->first();
        if (file_exists($pengaduan->path)) {
            unlink($pengaduan->path);
        }
        $pengaduan->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Pengaduan');
    }

    public function print($id)
    {
        $data = PengaduanServices::detail($id);
        // return $data;
        $cetak = Pdf::loadview('print.pengaduan',['data' => $data])->setPaper('a4','portrait');
        return $cetak->stream('print.pengaduan');
    }

    public function export()
    {
        return Excel::download(new PengaduanExport, 'pengaduan.xlsx');
        return redirect()->back()->with('success','Berhasil Export');
    }
}
