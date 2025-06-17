@extends('layouts.app')
@section('title','Buat Pengaduan')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Buat Pengaduan</div>
                <div class="card-body">
                    <form action="{{ route('siswa.pengaduan.store') }}" method="post" id="createPengaduan" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
                                    @error('tanggal')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tipe" class="form-label">Tipe Dokumentasi</label>
                                    <select name="tipe" id="tipe" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="audio">Audio</option>
                                        <option value="video">Video</option>
                                        <option value="photo">Gambar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="files" class="form-label">Dokumentasi</label>
                                    <input type="file" name="files" id="files" class="form-control @error('files') is-invalid @enderror">
                                    @error('files')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="laporan" class="form-label">Isi Laporan</label>
                                    <textarea name="laporan" id="laporan" cols="30" rows="10" class="form-control @error('laporan') is-invalid @enderror">{{ old('laporan') }}</textarea>
                                    @error('laporan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('siswa.dashboard') }}" class="btn btn-md btn-secondary">Kembali</a>
                    <button type="button" class="btn btn-md btn-primary" onclick="document.getElementById('createPengaduan').submit();">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
