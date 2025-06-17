@extends('layouts.app')
@section('title','Data Siswa')
@section('content')
@php
    $kelas = ['x','xi','xii'];
    $jurusan = ['ipa','ips'];
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Siswa</div>
                <div class="card-body">
                    <!-- Modal trigger button -->
                    <button
                        type="button"
                        class="btn btn-primary btn-md"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambah"
                    >
                        Tambah Siswa
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div
                        class="modal fade"
                        id="modalTambah"
                        tabindex="-1"
                        data-bs-backdrop="static"
                        data-bs-keyboard="false"

                        role="dialog"
                        aria-labelledby="modalTitleId"
                        aria-hidden="true"
                    >
                        <div
                            class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                            role="document"
                        >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Tambah Data Siswa
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.siswa.store') }}" method="post" id="createSiswa">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror">
                                                    @error('username')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                                                    @error('email')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                                    @error('password')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nisn" class="form-label">NISN</label>
                                                    <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror">
                                                    @error('nisn')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror">
                                                    @error('nama')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="kelas" class="form-label">Kelas</label>
                                                    <select name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                                        <option value="">Pilih Kelas</option>
                                                        @foreach ($kelas as $k)
                                                            <option value="{{ $k }}">{{ ucfirst($k) }}</option>
                                                        @endforeach
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
                                                        <option value="">Pilih Jurusan</option>
                                                        @foreach ($jurusan as $j)
                                                            <option value="{{ $j }}">{{ ucfirst($j) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('jurusan')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >
                                        Close
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('createSiswa').submit();">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($siswa as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->student->nisn }}</td>
                                <td>{{ $s->student->nama }}</td>
                                <td>{{ strtoupper($s->student->kelas) }}</td>
                                <td>{{ ucfirst($s->student->jurusan) }}</td>
                                <td>
                                    {{-- Modal Detail --}}
                                        <!-- Modal trigger button -->
                                        <button
                                            type="button"
                                            class="btn btn-info btn-md"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetail-{{ $s->id }}"
                                        >
                                            Detail
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div
                                            class="modal fade"
                                            id="modalDetail-{{ $s->id }}"
                                            tabindex="-1"
                                            data-bs-backdrop="static"
                                            data-bs-keyboard="false"

                                            role="dialog"
                                            aria-labelledby="modalTitleId"
                                            aria-hidden="true"
                                        >
                                            <div
                                                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                                                role="document"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Detail Siswa
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>NISN : </b> {{ $s->student->nisn }}</p>
                                                        <p><b>Nama : </b> {{ $s->student->nama }}</p>
                                                        <p><b>Kelas : </b> {{ strtoupper($s->student->kelas) }}</p>
                                                        <p><b>Jurusan : </b> {{ strtoupper($s->student->jurusan) }}</p>
                                                        <hr>
                                                        <p><b>Username : </b> {{ $s->username }}</p>
                                                        <p><b>Email : </b> {{ $s->email }}</p>
                                                        <hr>
                                                        <p><b>Orang Tua / Wali : </b> {{ $s->student->parents ? $s->student->parents->nama : 'Belum Ditambahkan' }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            Kembali
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- End Modal Detail --}}
                                    {{-- Modal Edit --}}
                                        <!-- Modal trigger button -->
                                        <button
                                            type="button"
                                            class="btn btn-warning btn-md"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit-{{ $s->id }}"
                                        >
                                            Edit
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div
                                            class="modal fade"
                                            id="modalEdit-{{ $s->id }}"
                                            tabindex="-1"
                                            data-bs-backdrop="static"
                                            data-bs-keyboard="false"

                                            role="dialog"
                                            aria-labelledby="modalTitleId"
                                            aria-hidden="true"
                                        >
                                            <div
                                                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                                                role="document"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Edit Data
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('user.siswa.store') }}" method="post" id="updateSiswa-{{ $s->id }}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $s->id }}">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="username" class="form-label">Username</label>
                                                                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ $s->username }}">
                                                                        @error('username')
                                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $s->email }}">
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
                                                                        <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ $s->student->nisn }}">
                                                                        @error('nisn')
                                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                                                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $s->student->nama }}">
                                                                        @error('nama')
                                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="kelas" class="form-label">Kelas</label>
                                                                        <select name="kelas" id="kelas" class="form-control @error('kelas') is-invalid @enderror" >
                                                                            <option value="">Pilih Kelas</option>
                                                                            @foreach ($kelas as $k)
                                                                                <option value="{{ $k }}" @if($k == $s->student->kelas) selected @endif>{{ ucfirst($k) }}</option>
                                                                            @endforeach
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
                                                                            <option value="">Pilih Jurusan</option>
                                                                            @foreach ($jurusan as $j)
                                                                                <option value="{{ $j }}" @if($j == $s->student->jurusan) selected @endif>{{ ucfirst($j) }}</option>
                                                                            @endforeach
                                                                            <opion value="ips">IPS</opion>
                                                                        </select>
                                                                        @error('jurusan')
                                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            Close
                                                        </button>
                                                        <button type="button" class="btn btn-warning" onclick="document.getElementById('updateSiswa-{{ $s->id }}').submit();">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- End Modal Edit --}}
                                    {{-- Modal Delete --}}
                                        <!-- Modal trigger button -->
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-md"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDelete-{{ $s->id }}"
                                        >
                                            Hapus
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div
                                            class="modal fade"
                                            id="modalDelete-{{ $s->id }}"
                                            tabindex="-1"
                                            data-bs-backdrop="static"
                                            data-bs-keyboard="false"

                                            role="dialog"
                                            aria-labelledby="modalTitleId"
                                            aria-hidden="true"
                                        >
                                            <div
                                                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                                                role="document"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Modal title
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Hapus Data Mahasiswa Dengan Nama {{ $s->student->nama }} ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            Close
                                                        </button>
                                                        <form action="{{ route('user.siswa.delete', $s->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- End Modal Delete --}}
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
