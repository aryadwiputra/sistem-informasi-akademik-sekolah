@extends('layouts.admin')

@section('title', 'Jadwal Kelas')

@php
    $headerData = [
        'pretitle' => 'Jadwal Kelas',
        'title' => 'Jadwal Kelas',
        'actions' => [
            ['label' => 'New view', 'url' => '#', 'class' => 'btn-green'],
            ['label' => 'Create new report', 'url' => '#', 'class' => 'btn-primary'],
        ],
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
                                        <th>Mata Pelajaran</th>
                                        <th>Jam Pelajaran</th>
                                        <th>Ruang Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $data)
                                        <tr>
                                            <td>{{ $data->hari->nama_hari }}</td>
                                            <td>
                                                <h5 class="card-title">{{ $data->mapel->nama_mapel }}</h5>
                                                <p class="card-text"><small
                                                        class="text-muted">{{ $data->guru->nama_guru }}</small></p>
                                            </td>
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
        $("#JadwalSiswa").addClass("active");
    </script>
@endsection
