@extends('layouts.app')

@section('css')
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
    <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=85bcdab218c46b6e2954810964abe5d21">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">


    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" language="javascript" src="../../../../examples/resources/demo.js"></script>
@endsection



@section('content')
    <div class="main">

        <div class="container mx-auto">

            <div class="shadow p-4 mx-auto">
                @php
                    $number = 1;
                    
                @endphp

                <h2 class="text-center mb-5">Data Pengajuan Cuti Karyawan</h2>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped display nowrap" style="width:100%;" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>No. Pengajuan</th>
                            <th>Jenis Cuti</th>
                            <th>Lama Cuti</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data_pengajuan as $data)
                            <tr>
                                <td>{{ $number }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->tgl_selesai }}</td>
                                <td>{{ $data->kode_pengajuan }}</td>
                                <td>{{ $data->jenis_cuti }}</td>
                                @if ($data->jenis_cuti == "Persalinan")
                                    <td>90 Hari</td>
                                @else
                                    <td>{{ $data->lama_pengajuan }} Hari</td>
                                @endif
                                <td>
                                    @if ($data->status == 0)
                                        <span class="badge bg-danger">Pengajuan
                                            ditolak</span>
                                    @elseif ($data->status == 1)
                                        <span class="badge bg-warning">Pengajuan sedang
                                            diproses</span>
                                    @elseif ($data->status == 2)
                                        <span class="badge bg-primary">Pengajuan sudah dicek
                                            oleh
                                            Kepala Divisi</span>
                                    @elseif ($data->status == 3)
                                        <span class="badge bg-success">Pengajuan
                                            diterima</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm bg-primary text-light" href="{{ $data->id }}/detail">Detail</a>
                                    
                                </td>
                            </tr>
                            @php
                                $number++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" class="init">
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            });
        });
    </script>
@endpush
