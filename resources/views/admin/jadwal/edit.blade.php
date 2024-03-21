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
                    <!-- general form elements -->
                    <div class="card card-primary">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Jadwal</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('jadwal.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hari_id">Hari</label>
                                            <select id="hari_id" name="hari_id"
                                                class="form-control @error('hari_id') is-invalid @enderror select2bs4">
                                                <option value="">-- Pilih Hari --</option>
                                                @foreach ($hari as $data)
                                                    <option value="{{ $data->id }}"
                                                        @if ($jadwal->hari_id == $data->id) selected @endif>
                                                        {{ $data->nama_hari }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelas_id">Kelas</label>
                                            <select id="kelas_id" name="kelas_id"
                                                class="form-control @error('kelas_id') is-invalid @enderror select2bs4">
                                                <option value="">-- Pilih Kelas --</option>
                                                @foreach ($kelas as $data)
                                                    <option value="{{ $data->id }}"
                                                        @if ($jadwal->kelas_id == $data->id) selected @endif>
                                                        {{ $data->nama_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="guru_id">Kode Mapel</label>
                                            <select id="guru_id" name="guru_id"
                                                class="form-control @error('guru_id') is-invalid @enderror select2bs4">
                                                <option value="" @if ($jadwal->guru_id) selected @endif>--
                                                    Pilih Kode
                                                    Mapel --</option>
                                                @foreach ($guru as $data)
                                                    <option value="{{ $data->id }}"
                                                        @if ($jadwal->guru_id == $data->id) selected @endif>
                                                        {{ $data->kode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jam_mulai">Jam Mulai</label>
                                            <input type='time' value="{{ $jadwal->jam_mulai }}" id="jam_mulai"
                                                name='jam_mulai'
                                                class="form-control @error('jam_mulai') is-invalid @enderror"
                                                placeholder='JJ:mm:dd'>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jam_selesai">Jam Selesai</label>
                                            <input type='time' value="{{ $jadwal->jam_selesai }}" name='jam_selesai'
                                                class="form-control @error('jam_selesai') is-invalid @enderror"
                                                placeholder='JJ:mm:dd'>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ruang_id">Ruang Kelas</label>
                                            <select id="ruang_id" name="ruang_id"
                                                class="form-control @error('ruang_id') is-invalid @enderror select2bs4">
                                                <option value="">-- Pilih Ruang Kelas --</option>
                                                @foreach ($ruang as $data)
                                                    <option value="{{ $data->id }}"
                                                        @if ($jadwal->ruang_id == $data->id) selected @endif>
                                                        {{ $data->nama_ruang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{ route('jadwal.show', Crypt::encrypt($jadwal->kelas_id)) }}" name="kembali"
                                    class="btn btn-default" id="back"> Kembali</a>
                                <button name="submit" class="btn btn-primary">
                                    Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#back').click(function() {
                window.location = "{{ route('jadwal.show', Crypt::encrypt($jadwal->kelas_id)) }}";
            });
        });
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataJadwal").addClass("active");
    </script>
@endsection
