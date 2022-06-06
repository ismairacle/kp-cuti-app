@extends('layouts.app')

@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection


@section('content')
    <main class="pt-5">
        <div class="container px-lg-5">

            <div class="row my-3 justify-content-center">
                <div class="col-sm-12">

                    @if (session('statusp'))
                        @push('scripts')
                            <script>
                                $(document).ready(function() {
                                    $("#statusp").modal('show');
                                });
                            </script>
                        @endpush
                    @endif


                    <!-- Modal Notification-->
                    <div class="modal fade" id="status" tabindex="-1" aria-labelledby="statusLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="text-center mt-5">

                                        <h3 class="m-4 text-center">
                                            Anda sedang mengajukan cuti, silahkan selesaikan prosesnya terlebih
                                            dahulu. jika ada perubahan
                                            data bisa dilakukan di menu edit pada tab riwayat.
                                        </h3>

                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Status --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Status Pengajuan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="px-auto">
                                        <table class="table table-borderless">

                                            @if ($pengajuan != null)
                                                <tr>
                                                    <td>No. Pengajuan</td>
                                                    <td>{{ $pengajuan->kode_pengajuan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Pengajuan</td>
                                                    <td>{{ $pengajuan->tgl_pengajuan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Lama Pengajuan</td>
                                                    @if ($pengajuan->jenis_cuti == 'Persalinan')
                                                        <td>90 Hari</td>
                                                    @else
                                                        <td>{{ $pengajuan->lama_pengajuan }} Hari</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>Status Aproval</td>
                                                    @if ($pengajuan->status == 0)
                                                        <td><span class="badge bg-danger">Pengajuan
                                                                ditolak</span></td>
                                                    @elseif ($pengajuan->status == 1)
                                                        <td><span class="badge bg-warning">Pengajuan sedang
                                                                diproses</span></td>
                                                    @elseif ($pengajuan->status == 2)
                                                        <td><span class="badge bg-primary">Pengajuan sudah dicek
                                                                oleh
                                                                Kepala Divisi</span></td>
                                                    @elseif ($pengajuan->status == 3)
                                                        <td><span class="badge bg-success">Pengajuan
                                                                diterima</span>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @else
                                                <h2 class="py-4 text-center">Belum ada pengajuan</h2>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Status Pengajuan --}}
                    <div class="modal fade" id="statusp" tabindex="-1" aria-labelledby="statuspLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="text-center mt-5">

                                        <h2>
                                            {{ session('statusp') }}
                                        </h2>

                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-transparent m-3 text-center">
                        <h1>
                            Selamat datang di Aplikasi Pengajuan Cuti Yayasan Griya Yatim dan Duafa.
                        </h1>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center my-5">

                <div class="col-sm-5 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <p class="card-text mb-3">Ajukan cuti sesuai dengan kebutuhan dan selalu koordinasi dengan
                                tim.
                                Ajukan cuti sesuai dengan saldo cuti yang tersedia </p>
                            @if ($status == 1 || $status == 2)
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#status">
                                    Ajukan Cuti
                                </button>
                            @else
                                <a class="btn btn-dark" href="{{ route('pengajuan') }}" role="button">Ajukan Cuti</a>
                            @endif


                        </div>
                    </div>
                </div>


                <div class="col-sm-5 mb-4">
                    <div class="card shadow">
                        <div class="card-body">

                            <p class="card-text">Status pengajuan cuti terakhir.
                            </p>
                            <h5>
                                @if ($pengajuan != null)
                                    @if ($pengajuan->status == 0)
                                        <td><span class="badge bg-danger">Pengajuan ditolak</span></td>
                                    @elseif ($pengajuan->status == 1)
                                        <td><span class="badge bg-warning">Pengajuan sedang diproses</span></td>
                                    @elseif ($pengajuan->status == 2)
                                        <td><span class="badge bg-primary">Pengajuan sudah dicek oleh Kepala
                                                Divisi</span>
                                        </td>
                                    @elseif ($pengajuan->status == 3)
                                        <td><span class="badge bg-success">Pengajuan diterima</span></td>
                                    @endif
                                @else
                                    <td><span class="badge bg-secondary">Belum ada pengajuan</span></td>
                                @endif
                            </h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark mt-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Lihat Detail
                            </button>



                        </div>
                    </div>
                </div>
            </div>

    </main>

    </div>
@endsection
