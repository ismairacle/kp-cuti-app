@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row col-md-5 mx-auto mb-4">
            <div class="card shadow" style="border-radius: .5rem;">
                <div class="card-body pt-4 pb-4">
                    <h4 class="mb-5 text-center">
                        Form Ubah Password
                    </h4>
                    <form class="row g-3" action="{{ route('edit-password') }}" method="POST">
                        @csrf
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                        <div class="col-md-12">
                            <label for="password1" class="form-label">Passwrod Sekarang</label>
                            <input type="password" class="form-control" id="password1" name="password1">
                        </div>
                        <div class="col-md-12">
                            <label for="password2" class="form-label">Passwrod Baru</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                        </div>
                        <div class="col-md-12">
                            <label for="password3" class="form-label">Konfirmasi Passwrod Baru</label>
                            <input type="password" class="form-control" id="password3" name="password3">
                        </div>

                        <div class="col-md-12 text-center mt-4">
                            <button type="submit" class="btn btn-dark">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
