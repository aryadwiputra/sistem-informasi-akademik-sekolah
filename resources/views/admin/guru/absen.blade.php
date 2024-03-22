@extends('layouts.admin')
@section('title', 'Data Absensi Guru')
@php
    $headerData = [
        'pretitle' => 'Guru',
        'title' => 'Data Absensi Guru',
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
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Guru</th>
                                        <th>Cek Absensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_guru }}</td>
                                            <td>
                                                <a href="{{ route('guru.kehadiran', Crypt::encrypt($data->id)) }}"
                                                    class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i>
                                                    &nbsp; Ditails</a>
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
        $("#AbsensiGuru").addClass("active");
    </script>
@endsection
