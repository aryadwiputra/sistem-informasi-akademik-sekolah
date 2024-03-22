@extends('layouts.admin')

@section('title', 'Trash Data Siswa')

@php
    $headerData = [
        'pretitle' => 'Trash Data Siswa',
        'title' => 'Trash Data Siswa',
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
                            <h3 class="card-title">Trash Data Siswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Siswa</th>
                                        <th>Nomor Induk</th>
                                        <th>Kelas</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_siswa }}</td>
                                            <td>{{ $data->no_induk }}</td>
                                            <td>{{ $data->kelas->nama_kelas }}</td>
                                            <td>
                                                <a href="{{ asset($data->foto) }}" data-toggle="lightbox"
                                                    data-title="Foto {{ $data->nama_siswa }}" data-gallery="gallery"
                                                    data-footer='<a href="{{ route('siswa.ubah-foto', Crypt::encrypt($data->id)) }}" id="linkFotoGuru" class="btn btn-link btn-block btn-light"><i class="nav-icon fas fa-file-upload"></i> &nbsp; Ubah Foto</a>'>
                                                    <img src="{{ asset($data->foto) }}" width="130px"
                                                        class="img-fluid mb-2">
                                                </a>
                                                {{-- https://siakad.didev.id/siswa/ubah-foto/{{$data->id}} --}}
                                            </td>
                                            <td>
                                                <form action="{{ route('siswa.kill', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('siswa.restore', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-success mt-2">Restore</a>
                                                    <button class="btn btn-danger mt-2"> Hapus</button>
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
        $("#TrashSiswa").addClass("active");
    </script>
@endsection
