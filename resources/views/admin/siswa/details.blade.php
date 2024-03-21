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
                            <a href="{{ route('siswa.kelas', Crypt::encrypt($siswa->kelas_id)) }}"
                                class="btn btn-default">Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters ml-2 mb-2 mr-2">
                                <div class="col-md-4">
                                    <img src="{{ asset($siswa->foto) }}" class="card-img img-details" alt="...">
                                </div>
                                <div class="col-md-1 mb-4"></div>
                                <div class="col-md-7">
                                    <h5 class="card-title card-text mb-2">Nama : {{ $siswa->nama_siswa }}</h5>
                                    <h5 class="card-title card-text mb-2">No. Induk : {{ $siswa->no_induk }}</h5>
                                    <h5 class="card-title card-text mb-2">NIS : {{ $siswa->nis }}</h5>
                                    <h5 class="card-title card-text mb-2">Kelas : {{ $siswa->kelas->nama_kelas }}</h5>
                                    @if ($siswa->jk == 'L')
                                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Laki-laki</h5>
                                    @else
                                        <h5 class="card-title card-text mb-2">Jenis Kelamin : Perempuan</h5>
                                    @endif
                                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $siswa->tmp_lahir }}</h5>
                                    <h5 class="card-title card-text mb-2">Tanggal Lahir :
                                        {{ date('l, d F Y', strtotime($siswa->tgl_lahir)) }}</h5>
                                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $siswa->telp }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataSiswa").addClass("active");
    </script>
@endsection
