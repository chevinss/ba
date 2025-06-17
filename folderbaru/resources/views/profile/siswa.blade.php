@extends('layouts.app')
@section('title','Profil Siswa')
@section('content')
@php
    $kelas = ['x','xi','xii'];
    $jurusan = ['ipa','ips'];
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Profil Siswa</div>
                <div class="card-body">
                    <form action="{{ route('update.siswa') }}" method="post" id="updateSiswa">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}">
                                    @error('username')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                    <span class="badge bg-info">Abaikan Jika Tidak Ingin Mengganti Password</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input type="text" readonly name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ $user->student->nisn }}">
                                    @error('nisn')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" readonly name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $user->student->nama }}">
                                    @error('nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror" >
                                        <option value="{{ $user->student->kelas }}" disabled selected>{{ strtoupper($user->student->kelas) }}</option>
                                    </select>
                                    @error('kelas')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <select name="jurusan" id="jurusan" class="form-control @error('jurusan') is-invalid @enderror">
                                        <option value="{{ $user->student->jurusan }}" disabled selected>{{ strtoupper($user->student->jurusan) }}</option>
                                    </select>
                                    @error('jurusan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-md btn-warning" onclick="document.getElementById('updateSiswa').submit();">Update Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
