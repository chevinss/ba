@extends('layouts.app')
@section('title','Detail Pengaduan')
@section('content')
<div class="container">
    <a href="{{ $isParent ? route('parent.detail.siswa', $pengaduan->student_id) : url('/home') }}" class="btn btn-md btn-secondary">Kembali</a>
    <hr>
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Detail Pengaduan</div>
                <div class="card-body">
                    <p><b>Tanggal Pengaduan : </b> {{ $pengaduan->tanggal }}</p>
                    <p><b>Isi Laporan : </b> {{ $pengaduan->isi_laporan }}</p>
                    <p><b>Status Laporan : </b>
                        @switch($pengaduan->status)
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
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Isi Tanggapan
                </div>
                <div class="card-body">
                    <p><b>Tanggal Ditanggapi : </b> {{ $pengaduan->tanggapan ? $pengaduan->tanggapan->tanggal : 'Belum Ditanggapi' }}</p>
                    <p><b>Isi Ditanggapi : </b> {{ $pengaduan->tanggapan ? $pengaduan->tanggapan->isi_tanggapan : 'Belum Ditanggapi' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Bukti Pengaduan</div>
                <div class="card-body">
                    @switch($pengaduan->type)
                        @case('photo')
                            <img src="{{ asset($pengaduan->path) }}" alt="Foto " class="container-fluid">
                            @break
                        @case('audio')
                            <audio controls>
                                <source src="{{ asset($pengaduan->path) }}">
                            </audio>
                            @break
                        @case('video')
                            <video width="400" controls>
                                <source src="{{ asset($pengaduan->path) }}">
                            </video>
                            @break
                        @default

                    @endswitch
                </div>
            </div>
        </div>
    </div>
    <hr>
    @if (Auth::user()->role == 'admin' && $pengaduan->status == 'p')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Form Tanggapan</div>
                    <div class="card-body">
                        <form action="{{ route('admin.tanggapan.store', $pengaduan->id) }}" method="post" id="tanggapan">
                            @csrf
                            <input type="hidden" name="id" value="{{ $pengaduan->tanggapan ? $pengaduan->tanggapan->id : '' }}">
                            <div class="form-group">
                                <label for="tanggal" class="form-label">Tanggal Tanggapan</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ $pengaduan->tanggapan ? $pengaduan->tanggapan->tanggal : '' }}">
                                @error('tanggal')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggapan" class="form-label">Isi Tanggapan</label>
                                <textarea name="tanggapan" id="tanggapan" cols="30" rows="10" class="form-control @error('tanggapan') is-invalid @enderror">{{ $pengaduan->tanggapan ? $pengaduan->tanggapan->isi_tanggapan : '' }}</textarea>
                                @error('tanggapan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-md btn-warning" onclick="document.getElementById('tanggapan').submit();">Tanggapi</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
