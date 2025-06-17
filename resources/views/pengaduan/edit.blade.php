@extends('layouts.app')
@section('title','Edit Pengaduan')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Buat Pengaduan</div>
                <div class="card-body">
                    <form action="{{ route('siswa.pengaduan.update', $pengaduan->id) }}" method="post" id="updatePengaduan" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ $pengaduan->tanggal }}">
                                    @error('tanggal')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tipe" class="form-label">Tipe Dokumen</label>
                                    <select name="tipe" id="tipe" class="form-control">
                                        <option value="audio" @if($pengaduan->type == 'audio') selected @endif>Audio</option>
                                        <option value="video" @if($pengaduan->type == 'video') selected @endif>Video</option>
                                        <option value="photo" @if($pengaduan->type == 'photo') selected @endif>Gambar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="files" class="form-label">Dokumentasi</label>
                                    <input type="file" name="files" id="files" class="form-control @error('files') is-invalid @enderror"  accept="image/*">
                                    <span class="badge bg-info">Abaikan Jika Tidak Ingin Mengubah Dokumentasi</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="laporan" class="form-label">Isi Laporan</label>
                                    <textarea name="laporan" id="laporan" cols="30" rows="10" class="form-control @error('laporan') is-invalid @enderror">{{ $pengaduan->isi_laporan }}</textarea>
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
                    <button type="button" class="btn btn-md btn-warning" onclick="document.getElementById('updatePengaduan').submit();">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
