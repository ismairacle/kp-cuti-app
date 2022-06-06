@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row col-md-5 mx-auto mb-4">
            <div class="card shadow" style="border-radius: .5rem;">
                <div class="card-body pt-4 pb-4">
                    <h4 class="mb-5 text-center">
                        Form Ubah Data Email dan Kontak
                    </h4>
                    <form class="row g-3" action="{{ route('edit-data') }}" method="POST">
                        @csrf
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                        <div class="col-md-12">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="col-md-12">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="kontak" name="kontak" value="{{ $user->kontak }}">
                        </div>

                        <div class="col-md-12 text-center mt-4">
                            <button type="submit" class="btn btn-dark">Ubah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
