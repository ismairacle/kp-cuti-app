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

                <h2 class="text-center mb-5">Data User</h2>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped display nowrap" style="width:100%;" id="myTable">
                    <div class="pb-3">
                        <a class="btn btn-sm bg-dark text-light" href="{{ route('tambah-user') }}">Tambah User</a>
                    </div>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>ID Karyawan</th>
                            <th>Roles</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Kontak</th>
                            <th>Email</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data_karyawan as $data)
                            <tr>
                                <td>{{ $number }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->id_karyawan }}</td>
                                <td>{{ Str::replaceLast('"]', '', Str::replaceFirst('["', '', $data->getRoleNames())) }}
                                </td>
                                <td>{{ $data->divisi }}</td>
                                <td>{{ $data->jabatan }}</td>
                                <td>{{ $data->kontak }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <a class="btn btn-sm bg-primary text-light" href="admin/{{ $data->id }}/detail"><img
                                            fill="currentColor" src="{{ asset('img/eye.svg') }}" alt=""></a>
                                    <a class="btn btn-sm bg-warning text-light" href="admin/{{ $data->id }}/update"><img
                                            src="{{ asset('img/pencil-square.svg') }}" alt=""></a>

                                    {{-- <a href="{{ $data->id }}/delete" class="btn btn-sm bg-danger"
                                onclick="return confirm('Hapus data?')"><img src="{{ asset('img/trash3.svg') }}"
                                    alt=""></a> --}}

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
