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

                    @if ($status == 1 || $status == 2)
                        <h3 class="my-5 p-5 text-center">
                            Anda sedang mengajukan cuti, silahkan selesaikan prosesnya terlebih dahulu. jika ada perubahan
                            data bisa dilakukan di menu edit pada tab riwayat.
                        </h3>
                    @else
                        <h4 class="mb-5 text-center">
                            Form Pengajuan Cuti
                        </h4>
                        @if (session('message'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form class="row g-3" action="{{ route('create') }}" method="POST">
                            @csrf
                            <div x-data="{ open: true }">


                                <div class="col-md-12">
                                    <label class="form-label">Jenis Cuti</label>

                                    <div class="d-flex flex-wrap">
                                        @if (auth()->user()->jenis_kelamin == 'Perempuan')
                                            <div class="form-check" x-on:click="open = false">
                                                <input class="form-check-input" type="radio" name="jenis" id="jenis1"
                                                    value="Persalinan">
                                                <label class="form-check-label" for="jenis1">
                                                    Persalinan
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-wrap">

                                        <div class="form-check" x-on:click="open = true">
                                            <input class="form-check-input" type="radio" name="jenis" id="jenis2"
                                                value="Pernikahan">
                                            <label class="form-check-label" for="jenis2">
                                                Pernikahan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap">

                                        <div class="form-check" x-on:click="open = true">
                                            <input class="form-check-input" type="radio" name="jenis" id="jenis3"
                                                value="Tahunan">
                                            <label class="form-check-label" for="jenis3">
                                                Tahunan
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                                        <input type="text" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
                                    </div>
                                    <div class="col-md-6" x-show="open">
                                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                        <input type="text" class="form-control" id="tgl_selesai" name="tgl_selesai"
                                            >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" rows="3" name="keterangan" required></textarea>
                                </div>
                                <div class="col-md-12 text-center mt-4">
                                    <button type="submit" id="submitForm" class="btn btn-dark">Ajukan Cuti</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $("#tgl_mulai").datepicker({
                minDate: +7
            });
            $("#tgl_selesai").datepicker({
                minDate: +8
            });
        });
    </script>
@endpush
