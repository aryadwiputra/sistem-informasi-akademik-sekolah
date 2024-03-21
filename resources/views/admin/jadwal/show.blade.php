@extends('layouts.admin')

@section('title', 'Detail Jadwal')

@php
    $headerData = [
        'pretitle' => 'Detail Jadwal',
        'title' => 'Detail Jadwal',
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
                        <div class="card-header">
                            <a href="{{ route('jadwal.index') }}" class="btn btn-default">
                                Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Hari</th>
                                        <th>Jadwal</th>
                                        <th>Jam Pelajaran</th>
                                        <th>Ruang Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->hari->nama_hari }}</td>
                                            <td>
                                                <h5 class="card-title">{{ $data->mapel->nama_mapel }}</h5>
                                                <p class="card-text"><small
                                                        class="text-muted">{{ $data->guru->nama_guru }}</small></p>
                                            </td>
                                            <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                                            <td>{{ $data->ruang->nama_ruang }}</td>
                                            <td>
                                                <form action="{{ route('jadwal.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('jadwal.edit', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-success">
                                                        Edit</a>
                                                    <button class="btn btn-danger">
                                                        Hapus</button>
                                                </form>
                                            </td>
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
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataJadwal").addClass("active");
    </script>
@endsection
