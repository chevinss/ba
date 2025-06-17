@extends('layouts.app')
@section('title','Data Orang Tua Murid')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Orang Tua Murid</div>
                <div class="card-body">
                    <!-- Modal trigger button -->
                    <button
                        type="button"
                        class="btn btn-primary btn-md"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambah"
                    >
                        Tambah Orang Tua
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
                                        Tambah Data Orang Tua Murid
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.parent.store') }}" method="post" id="createParents">
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
                                                    <label for="uuid" class="form-label">NIK</label>
                                                    <input type="text" name="uuid" id="uuid" class="form-control @error('uuid') is-invalid @enderror">
                                                    @error('uuid')
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
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('createParents').submit();">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parent as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->parents->uuid }}</td>
                                <td>{{ $p->parents->nama }}</td>
                                <td>
                                    {{-- Modal Detail --}}
                                        <a href="{{ route('user.parent.detail', $p->parents->id) }}" class="btn btn-md btn-info">Detail</a>
                                    {{-- End Modal Detail --}}
                                    {{-- Modal Edit --}}
                                        <!-- Modal trigger button -->
                                        <button
                                            type="button"
                                            class="btn btn-warning btn-md"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit-{{ $p->id }}"
                                        >
                                            Edit
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div
                                            class="modal fade"
                                            id="modalEdit-{{ $p->id }}"
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
                                                        <form action="{{ route('user.parent.store') }}" method="post" id="updateParents-{{ $p->id }}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $p->id }}">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="username" class="form-label">Username</label>
                                                                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ $p->username }}">
                                                                        @error('username')
                                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $p->email }}">
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
                                                                        <label for="uuid" class="form-label">NIK</label>
                                                                        <input type="text" name="uuid" id="uuid" class="form-control @error('uuid') is-invalid @enderror" value="{{ $p->parents->uuid }}">
                                                                        @error('uuid')
                                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                                                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $p->parents->nama }}">
                                                                        @error('nama')
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
                                                        <button type="button" class="btn btn-warning" onclick="document.getElementById('updateParents-{{ $p->id }}').submit();">Update</button>
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
                                                        <p>Hapus Data Orang Tua Dengan Nama {{ $p->parents->nama }} ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            Close
                                                        </button>
                                                        <form action="{{ route('user.parent.delete', $p->id) }}" method="post">
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
