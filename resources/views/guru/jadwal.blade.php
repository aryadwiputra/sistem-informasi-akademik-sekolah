{{-- @extends('template_backend.home')
@section('heading', 'Jadwal Guru')
@section('heading')
    Jadwal Guru {{ Auth::user()->guru(Auth::user()->id_card)->nama_guru }}
@endsection
@section('page')
  <li class="breadcrumb-item active">Jadwal Guru</li>
@endsection
@section('content') --}}
@extends('layouts.admin')

@section('title', 'Jadwal')

@php
    $headerData = [
        'pretitle' => 'Jadwal',
        'title' => 'Jadwal',
        'actions' => [],
    ];
@endphp

@section('content')
    @include('components.header', $headerData)

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Kelas</th>
                                        <th>Jam Mengajar</th>
                                        <th>Ruang Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $data)
                                        <tr>
                                            <td>{{ $data->hari->nama_hari }}</td>
                                            <td>{{ $data->kelas->nama_kelas }}</td>
                                            <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                                            <td>{{ $data->ruang->nama_ruang }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.col -->
@endsection
@section('script')
    <script>
        $("#JadwalGuru").addClass("active");
    </script>
@endsection
