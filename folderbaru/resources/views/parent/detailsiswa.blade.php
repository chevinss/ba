@extends('layouts.app')
@section('title','Detail Siswa')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detail Siswa</div>
                <div class="card-body">
                    <a href="{{ url('/home') }}" class="btn btn-md btn-secondary">Kembali</a>
                    <hr>
                    <p><b>NISN : </b> {{ $data->nisn }}</p>
                    <p><b>Nama : </b> {{ $data->nama }}</p>
                    <p><b>Kelas : </b> {{ strtoupper($data->kelas) }}</p>
                    <p><b>Jurusan : </b> {{ strtoupper($data->jurusan) }}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar Pengaduan</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Jumlah Laporan
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $pengaduan['total'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Laporan Belum Ditanggapi
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $pengaduan['s'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Laporan Sedang  Ditanggapi
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $pengaduan['p'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Laporan Selesai Ditanggapi
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $pengaduan['f'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Lapor</th>
                                <th>Status Laporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data->pengaduan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>
                                    @switch($p->status)
                                        @case('s')
                                            <span class="badge bg-danger">Belum Ditanggapi</span>
                                            @break
                                        @case('p')
                                            <span class="badge bg-warning">Sedang Diproses</span>
                                            @break
                                        @case('f')
                                            <span class="badge bg-success">Sudah Ditanggapi</span>
                                            @break
                                        @default

                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('parent.detail.pengaduan', $p->id) }}" class="btn btn-md btn-info @if($p->status == 'p') disabled @endif">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum Ada Pengaduan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
