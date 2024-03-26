@extends('layouts.admin')

@section('title', 'Data Ulangan')

@php
    $headerData = [
        'pretitle' => 'Data Ulangan',
        'title' => 'Data Ulangan',
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Nilai Ulangan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Kelas</th>
                                                <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($kelas as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->nama_kelas }}</td>
                                                    <td><a href="{{ route('ulangan-siswa', Crypt::encrypt($data->id)) }}"
                                                            class="btn btn-info">Detail</a></td>
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
        $("#Ulangan").addClass("active");
    </script>
@endsection
