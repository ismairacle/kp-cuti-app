@extends('layouts.app')

@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection

@section('content')
    @if (session('status'))
        @push('scripts')
            <script>
                $(document).ready(function() {
                    $("#status").modal('show');
                });
            </script>
        @endpush
    @endif
    <div class="modal fade" id="status" tabindex="-1" aria-labelledby="statusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-5">

                        <h2>
                            {{ session('status') }}
                        </h2>

                    </div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto">
        <div class="row py-4 mx-auto border shadow rounded bg-white">
            <div class="col-md-3 ">
                <div class="p-3">

                    <div class="d-flex flex-column align-items-center p-2"><img class="rounded-circle mt-4" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                            class="font-weight-bold">{{ $user->name }}</span>
                        <span class="text-black-50">{{ $user->divisi }}</span>

                    </div>
                </div>
                <div class="row mx-auto text-center">
                    <div class="col-4 px-3">Persalinan</div>
                    <div class="col-4 px-3">Pernikahan</div>
                    <div class="col-4 px-3">Tahunan</div>
                </div>
                <div class="row mx-auto text-center mt-2">
                    <div class="col-4 px-3">
                        <h4>{{ $user->cuti->persalinan }}</h4>
                    </div>
                    <div class="col-4 px-3">
                        <h4>{{ $user->cuti->pernikahan }}</h4>
                    </div>
                    <div class="col-4 px-3">
                        <h4>{{ $user->cuti->tahunan }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="p-3">
                    <div class="d-flex justify-content-between align-items-center ">
                        <h2 class="text-right ">Pengaturan Akun</h2>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Nama Lengkap</label>
                            <input type="text" class="form-control mt-1" value="{{ $user->name }}" disabled>
                        </div>

                        <div class="col-md-12 mt-2"><label class="labels">ID Karyawan</label><input type="text"
                                class="form-control mt-1" value="{{ $user->id_karyawan }}" disabled></div>
                        <div class="col-md-6 mt-2"><label class="labels">Divisi</label><input type="text"
                                class="form-control mt-1" value="{{ $user->divisi }}" disabled></div>
                        <div class="col-md-6 mt-2"><label class="labels">Jabatan</label><input type="text"
                                class="form-control mt-1" value="{{ $user->jabatan }}" disabled></div>
                        <div class="col-md-6 mt-2"><label class="labels">E-mail</label><input type="text"
                                class="form-control mt-1" value="{{ $user->email }}" disabled></div>
                        <div class="col-md-6 mt-2"><label class="labels">Kontak</label><input type="text"
                                class="form-control mt-1" value="{{ $user->kontak }}" disabled></div>

                    </div>


                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <br>
                    <div class="col-md-12">
                        <p>
                            Silahkan ubah password anda, hindari password yang gambang ditebak oleh orang-orang terdekat
                            anda
                        </p>
                    </div>
                    <div class="col-md-8 d-grid gap-2 mt-2">
                        <a class="btn btn-dark px-5" href="{{ route('ubah-password') }}" role="button">Ubah Password</a>
                    </div>
                    <div class="col-md-8 d-grid gap-2 mt-3">
                        <a class="btn btn-dark px-5" href="{{ route('ubah-data') }}" role="button">Ubah Data</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
