@extends('layouts.admin')

@section('title', 'Data Siswa')

@php
    $headerData = [
        'pretitle' => 'Data Siswa',
        'title' => 'Data Siswa',
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
                            <a href="{{ route('siswa.index') }}" class="btn btn-default ">Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Siswa</th>
                                        <th>No Induk</th>
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
                                            <td>
                                                <a href="{{ asset($data->foto) }}" data-toggle="lightbox"
                                                    data-title="Foto {{ $data->nama_siswa }}" data-gallery="gallery"
                                                    data-footer='<a href="{{ route('siswa.ubah-foto', Crypt::encrypt($data->id)) }}" id="linkFotoGuru" class="btn btn-link btn-block btn-light"><i class="nav-icon fas fa-file-upload"></i>  Ubah Foto</a>'>
                                                    <img src="{{ asset($data->foto) }}" width="130px"
                                                        class="img-fluid mb-2">
                                                </a>
                                                {{-- https://siakad.didev.id/siswa/ubah-foto/{{$data->id}} --}}
                                            </td>
                                            <td>
                                                <form action="{{ route('siswa.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('siswa.show', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-info mt-2">
                                                        Detail</a>
                                                    <a href="{{ route('siswa.edit', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-success mt-2">
                                                        Edit</a>
                                                    <button class="btn btn-danger mt-2"> Hapus</button>
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
                <!-- /.col -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataSiswa").addClass("active");
    </script>
@endsection
