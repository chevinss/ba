@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">Dashboard Admin</div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-header">Jumlah Laporan</div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $data['total'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header">Laporan Belum Ditanggapi</div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $data['s'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-header">Laporan Sedang Ditanggapi </div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $data['p'] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">Laporan Selesai Ditanggapi</div>
                                <div class="card-body">
                                    <h1 class="text-center">{{ $data['f'] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Lapor</th>
                                <th>Pelapor</th>
                                <th>Status Laporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->student->nama }}</td>
                                <td>
                                    @switch($p->status)
                                        @case('s')
                                            <span class="badge bg-danger">Belum Ditanggapi</span>
                                            @break
                                        @case('p')
                                            <span class="badge bg-warning">Sedang Ditanggapi</span>
                                            @break
                                        @case('f')
                                            <span class="badge bg-success">Sudah Ditanggapi</span>
                                            @break
                                        @default

                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('kepsek.pengaduan.detail', $p->id) }}" class="btn btn-md btn-info">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
