<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use App\Services\ParentServices;
use App\Services\PengaduanServices;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        $pengaduan = PengaduanServices::list();
        // $data['total'] = Pengaduan::count();
        $data['total'] = $pengaduan->count();
        $data['s'] = Pengaduan::where('status','s')->count();
        $data['p'] = Pengaduan::where('status','p')->count();
        $data['f'] = Pengaduan::where('status','f')->count();
        return view('dashboard.admin',compact('pengaduan','data'));
    }

    public function siswa()
    {
        $student = Auth::user()->student->id;
        $pengaduan = Pengaduan::where('student_id', $student)->get();
        $data['total'] = Pengaduan::where('student_id', $student)->count();
        $data['s'] = Pengaduan::where('student_id', $student)->where('status','s')->count();
        $data['p'] = Pengaduan::where('student_id', $student)->where('status','p')->count();
        $data['f'] = Pengaduan::where('student_id', $student)->where('status','f')->count();
        return view('dashboard.siswa', compact('pengaduan','data'));
    }

    public function parent()
    {
        $parent = Auth::user()->parents->id;
        $siswa = ParentServices::siswa($parent);
        return view('dashboard.parent', compact('siswa'));
    }

    public function kepsek()
    {
        $pengaduan = PengaduanServices::list();
        $data['total'] = $pengaduan->count();
        $data['s'] = $pengaduan->where('status', 's')->count();
        $data['p'] = $pengaduan->where('status', 'p')->count();
        $data['f'] = $pengaduan->where('status', 'f')->count();
        return view('dashboard.kepsek',compact('pengaduan','data'));
    }
}
