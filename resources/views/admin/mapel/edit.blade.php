@extends('layouts.admin')
@section('title', 'Edit Mata Pelajaran')

@php
    $headerData = [
        'pretitle' => 'Mata Pelajaran',
        'title' => 'Edit Mata Pelajaran',
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
                            <h3 class="card-title">Edit Data Mapel</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('mapel.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                                        <div class="form-group">
                                            <label class="form-label" for="nama_mapel">Nama Mapel</label>
                                            <input type="text" id="nama_mapel" name="nama_mapel"
                                                value="{{ $mapel->nama_mapel }}"
                                                class="form-control @error('nama_mapel') is-invalid @enderror"
                                                placeholder="{{ __('Nama Mata Pelajaran') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="#" name="kembali" class="btn btn-default" id="back">Kembali</a>
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
                window.location = "{{ route('mapel.index') }}";
            });
        });
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataMapel").addClass("active");
    </script>
@endsection
