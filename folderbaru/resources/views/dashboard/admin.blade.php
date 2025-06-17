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
                    <a href="{{ route('admin.export') }}" class="btn btn-md btn-success">Export Ke Excel</a>
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
                                    <a href="{{ route('admin.tanggapan', $p->id) }}" class="btn btn-md btn-info">Detail</a>
                                    @switch($p->status)
                                        @case('s')
                                            <!-- Modal trigger button -->
                                            <button
                                                type="button"
                                                class="btn btn-warning btn-md"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalProses-{{ $p->id }}"
                                            >
                                                Tanggapi
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div
                                                class="modal fade"
                                                id="modalProses-{{ $p->id }}"
                                                tabindex="-1"
                                                data-bs-backdrop="static"
                                                data-bs-keyboard="false"

                                                role="dialog"
                                                aria-labelledby="modalTitleId"
                                                aria-hidden="true"
                                            >
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                    role="document"
                                                >
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Tanggapi Laporan
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Ingin Menanggapi Laporan Atas Nama {{ $p->student->nama }} Pada Tanggal {{ $p->tanggal }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Close
                                                            </button>
                                                            <form action="{{ route('admin.proses', $p->id) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-warning">Tanggapi</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                        @case('p')
                                            <!-- Modal trigger button -->
                                            <button
                                                type="button"
                                                class="btn btn-success btn-md"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalSelesai-{{ $p->id }}"
                                                @if (!$p->tanggapan)
                                                    disabled
                                                @endif
                                            >
                                                Selesaikan
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div
                                                class="modal fade"
                                                id="modalSelesai-{{ $p->id }}"
                                                tabindex="-1"
                                                data-bs-backdrop="static"
                                                data-bs-keyboard="false"

                                                role="dialog"
                                                aria-labelledby="modalTitleId"
                                                aria-hidden="true"
                                            >
                                                <div
                                                    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                    role="document"
                                                >
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Selesaikan Laporan
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Ingin Menyelesaikan Laporan Atas Nama {{ $p->student->nama }} Pada Tanggal {{ $p->tanggal }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Close
                                                            </button>
                                                            <form action="{{ route('admin.selesai', $p->id) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Selesaikan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                        @case('f')
                                            <a href="{{ route('admin.pengaduan.cetak', $p->id) }}" target="_blank" class="btn btn-md btn-secondary">Cetak</a>
                                            @break
                                        @default

                                    @endswitch
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
