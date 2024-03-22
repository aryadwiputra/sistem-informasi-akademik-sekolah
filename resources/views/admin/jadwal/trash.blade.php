@extends('layouts.admin')

@section('title', 'Trash Jadwal')

@php
    $headerData = [
        'pretitle' => 'Trash Jadwal',
        'title' => 'Trash Jadwal',
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Trash Data Jawdal</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Hari</th>
                                        <th>Jadwal</th>
                                        <th>Kelas</th>
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
                                            <td>{{ $data->kelas->nama_kelas }}</td>
                                            <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                                            <td>{{ $data->ruang->nama_ruang }}</td>
                                            <td>
                                                <form action="{{ route('jadwal.kill', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('jadwal.restore', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-success mt-2">Restore</a>
                                                    <button class="btn btn-danger mt-2">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#ViewTrash").addClass("active");
        $("#liViewTrash").addClass("menu-open");
        $("#TrashJadwal").addClass("active");
    </script>
@endsection
