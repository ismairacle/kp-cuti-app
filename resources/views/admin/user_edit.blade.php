@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row col-md-5 mx-auto mb-4">
            <div class="card shadow" style="border-radius: .5rem;">
                <div class="card-body pt-4 pb-4">
                    <h4 class="mb-5 text-center">
                        Form Ubah Data User
                    </h4>
                    <form class="row g-3" action="{{ route('update-user') }}" method="POST">
                        @csrf
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                        <div class="col-md-12">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                                disabled>
                            <input type="text" class="form-control" id="id" name="id" value="{{ $user->id }}"
                                hidden>
                        </div>
                        <div class="col-md-12">
                            <label for="roles" class="form-label">Roles</label>
                            <select class="form-select" id="roles" name="roles" required>
                                <option>-- Pilih Roles --</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="approver">Approver</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="divisi" class="form-label">Divisi</label>
                            <select class="form-select" id="divisi" name="divisi" required>
                                <option>-- Pilih Divisi --</option>
                                <option value="Divisi 1">Divisi 1</option>
                                <option value="Divisi 2">Divisi 2</option>
                                <option value="Divisi 3">Divisi 3</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-select" id="jabatan" name="jabatan" required>
                                <option>-- Pilih Jabatan --</option>
                                <option value="Jabatan 1">Jabatan 1</option>
                                <option value="Jabatan 2">Jabatan 2</option>
                                <option value="Jabatan 3">Jabatan 3</option>
                            </select>
                        </div>

                        <div class="col-md-12 text-center mt-4">
                            <button type="submit" class="btn btn-dark">Ubah Data User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
