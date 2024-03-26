@extends('layouts.admin')

@section('title', 'Data Sikap')

@php
    $headerData = [
        'pretitle' => 'Data Sikap',
        'title' => 'Data Sikap',
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
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('sikap-kelas') }}" class="btn btn-default">Kembali</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Siswa</th>
                                                <th>No. Induk</th>
                                                <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->nama_siswa }}</td>
                                                    <td>{{ $data->no_induk }}</td>
                                                    <td><a href="{{ route('sikap-show', Crypt::encrypt($data->id)) }}"
                                                            class="btn btn-info"> Show Nilai
                                                            Sikap</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Sikap").addClass("active");
    </script>
@endsection
