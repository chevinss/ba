@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">Dashboard Siswa</div>
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
                                <div class="card-header">Laporan Sedang Ditanggapi</div>
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
                    <a href="{{ route('siswa.pengaduan.create') }}" class="btn btn-primary btn-md">Buat Pengaduan</a>
                    <hr>
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
                            @foreach ($pengaduan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->tanggal }}</td>
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
                                    <a href="{{ route('siswa.pengaduan.detail', $p->id) }}" class="btn btn-md btn-info @if($p->status == 'p') disabled @endif">Detail</a>
                                    @if ($p->status == 's')
                                    <a href="{{ route('siswa.pengaduan.edit', $p->id) }}" class="btn btn-md btn-warning">Edit</a>
                                    <!-- Modal trigger button -->
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-md"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDelete-{{ $p->id }}"
                                    >
                                        Hapus
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div
                                        class="modal fade"
                                        id="modalDelete-{{ $p->id }}"
                                        tabindex="-1"
                                        data-bs-backdrop="static"
                                        data-bs-keyboard="false"

                                        role="dialog"
                                        aria-labelledby="modalTitleId"
                                        aria-hidden="true"
                                    >
                                        <div
                                            class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md
                                            role="document"
                                        >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Hapus Pengaduan
                                                    </h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Hapus Pengaduan Pada Tanggal {{ $p->tanggal }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal"
                                                    >
                                                        Kembali
                                                    </button>
                                                    <form action="{{ route('siswa.pengaduan.delete', $p->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

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
