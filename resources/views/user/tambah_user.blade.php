@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row col-md-6 mx-auto mb-5">
            <div class="card shadow" style="border-radius: .5rem;">

                <div class="card-body pt-4 pb-4">

                    <h4 class="mb-5 text-center">
                        Form Tambah User
                    </h4>
                    @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form class="row g-3" action="{{ route('insert-user') }}" method="POST">
                        @csrf
                        <div x-data="{ open: true }">


                            <div class="col-md-12">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-12">
                                <label for="roles" class="form-label">Roles</label>
                                <select class="form-select" id="roles" name="roles" required>
                                    <option>-- Pilih Roles --</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="approver1">HRD</option>
                                    <option value="approver2">Kepala Divisi</option>
                                </select>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="divisi" class="form-label">Divisi</label>
                                    <select class="form-select" id="divisi" name="divisi" required>
                                        <option>-- Pilih Divisi --</option>
                                        <option value="Divisi 1">Divisi 1</option>
                                        <option value="Divisi 2">Divisi 2</option>
                                        <option value="Divisi 3">Divisi 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <select class="form-select" id="jabatan" name="jabatan" required>
                                        <option>-- Pilih Jabatan --</option>
                                        <option value="Jabatan 1">Jabatan 1</option>
                                        <option value="Jabatan 2">Jabatan 2</option>
                                        <option value="Jabatan 3">Jabatan 3</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" class="form-control" id="kontak" name="kontak" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option>-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" id="submitForm" class="btn btn-dark">Tambah User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
