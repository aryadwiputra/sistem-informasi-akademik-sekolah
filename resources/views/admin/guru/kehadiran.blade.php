@extends('layouts.admin')
@section('title', 'Data Kehadiran Guru')
@php
    $headerData = [
        'pretitle' => 'Guru',
        'title' => 'Data Kehadiran Guru',
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
                            <a href="{{ route('guru.index') }}" class="btn btn-default btn-sm"><i
                                    class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absen as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('l, d F Y', strtotime($data->tanggal)) }}</td>
                                            <td>{{ $data->kehadiran->ket }}</td>
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
        $("#AbsensiGuru").addClass("active");
    </script>
@endsection
