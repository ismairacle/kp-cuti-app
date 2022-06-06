@extends('layouts.app')

@section('content')
    <div class="container-sm mx-auto">

        <div class="container">
            <!-- Main content -->
            <div class="row mx-auto">
                <h1 class="text-center my-4 text-bold">Detail Pengajuan Cuti</h1>
                <div class="col-lg-6 mt-2">
                    <!-- Details -->
                    <div class="card  mb-4">
                        <div class="card-body">
                            <h3 class="h6 text-bold">Detail Pengajuan</h3>

                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>No Pengajuan</td>
                                        <td>:</td>
                                        <td>{{ $detail->kode_pengajuan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{ $detail->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID Karyawan</td>
                                        <td>:</td>
                                        <td>{{ $detail->kode_pengajuan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pengajuan</td>
                                        <td>:</td>
                                        <td>{{ $detail->tgl_pengajuan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai Cuti</td>
                                        <td>:</td>
                                        <td>{{ $detail->tgl_mulai }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Selesai Cuti</td>
                                        <td>:</td>
                                        <td>{{ $detail->tgl_selesai }}</td>
                                    </tr>
                                    <tr>
                                        <td>Lama Cuti</td>
                                        <td>:</td>
                                        <td>{{ $detail->lama_pengajuan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Cuti</td>
                                        <td>:</td>
                                        <td>{{ $detail->jenis_cuti }}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- Payment -->

                </div>
                <div class="col-lg-6 mt-2">
                    <!-- Customer Notes -->

                    @if (Auth::user()->hasRole('approver'))
                        <div class="card mb-4">
                            <div class="mt-4 mx-auto">
                                <h4 class="fw-semibold">Silahkan setujui pengajuan atau tolak pengajuan</h>
                            </div>
                            <div class="row card-body mx-auto">
                                <div class="col-md-6">
                                    <form action="{{ route('accept') }}" method="POST">
                                        @csrf
                                        @if (Auth::user()->jabatan == 'Kepala Divisi')
                                            <input type="text" value="2" hidden name="status">
                                        @else
                                            <input type="text" value="3" hidden name="status">
                                        @endif
                                        <input type="text" value="{{ $detail->id }}" hidden name="id">
                                        <button type="submit" class="btn btn-success">Setujui</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    @if (Auth::user()->jabatan == 'HRD')
                                        <form action="{{ route('reject') }}" method="POST">
                                            @csrf
                                            <input type="text" value="0" hidden name="status">
                                            <input type="text" value="{{ $detail->id }}" hidden name="id">
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </form>
                                    @endif


                                </div>


                            </div>
                        </div>
                    @endif



                    <div class="card  mb-4">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        @if ($detail->status == 0)
                                            <td><span class="badge bg-danger">Pengajuan ditolak</span></td>
                                        @elseif ($detail->status == 1)
                                            <td><span class="badge bg-warning">Pengajuan sedang diproses</span></td>
                                        @elseif ($detail->status == 2)
                                            <td><span class="badge bg-primary">Pengajuan sudah dicek oleh Kepala
                                                    Divisi</span>
                                            </td>
                                        @elseif ($detail->status == 3)
                                            <td><span class="badge bg-success">Pengajuan diterima</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Aproval Kepala Divisi</td>
                                        <td>:</td>
                                        @if ($detail->status >= 2 && $detail->status <= 4)
                                            <td><span class="badge bg-success">OK</span></td>
                                        @elseif ($detail->status == 0)
                                            <td><span class="badge bg-danger">Ditolak</span></td>
                                        @elseif ($detail->status == 1)
                                            <td><span class="badge bg-warning">Menunggu</span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Aproval Manajer</td>
                                        <td>:</td>
                                        @if ($detail->status == 3 && $detail->status <= 4)
                                            <td><span class="badge bg-success">OK</span></td>
                                        @elseif ($detail->status == 0)
                                            <td><span class="badge bg-danger">Ditolak</span></td>
                                        @elseif ($detail->status > 0 && $detail->status < 3)
                                            <td><span class="badge bg-warning">Menunggu</span></td>
                                        @endif

                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>
                                            <p>{{ $detail->keterangan }}</p>
                                        </td>
                                    </tr>
                                </tbody>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    </div>
@endsection('content')
