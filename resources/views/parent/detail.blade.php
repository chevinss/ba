@extends('layouts.app')
@section('title','Data Orang Tua Murid')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detail Orang Tua</div>
                <div class="card-body">
                    <a href="{{ route('user.parent.index') }}" class="btn btn-md btn-secondary">Kembali</a>
                    <hr>
                    <p><b>NIK : </b> {{ $parent->uuid }}</p>
                    <p><b>Nama : </b> {{ $parent->nama }}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar Siswa</div>
                <div class="card-body">
                    <form action="{{ route('parent.add.student', $parent->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <label for="select-input" class="form-label">Nama Siswa</label>
                                <select name="siswa_id" id="select-input" class="form-select" style="width: 100%;">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($siswa['list'] as $s)
                                        <option value="{{ $s->student->id }}">{{ $s->student->nisn .' - ' .$s->student->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success btn-md">Tambah</button>
                            </div>
                        </div>
                    </form>
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
                            @foreach ($siswa['parent'] as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nisn }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ strtoupper($s->kelas) }}</td>
                                    <td>{{ strtoupper($s->jurusan) }}</td>
                                    <td>
                                        <!-- Modal trigger button -->
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm"
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
                                                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                role="document"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Hapus Siswa
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Hapus {{ $s->nama }} dari daftar ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            Close
                                                        </button>
                                                        <form action="{{ route('parent.remove.student', $parent->id) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="siswa_id" value="{{ $s->id }}">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@section('script')
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('#select-input').select2({
            tags: true, // memungkinkan input teks baru
            placeholder: "Pilih atau ketik nama",
            allowClear: true
        });
    });
</script>
@endsection
