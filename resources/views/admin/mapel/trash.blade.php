@extends('layouts.admin')

@section('title', 'Trash Mata Pelajaran')

@php
    $headerData = [
        'pretitle' => 'Trash Mata Pelajaran',
        'title' => 'Trash Mata Pelajaran',
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
                @php
                    $no = 1;
                @endphp
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Trash Data Mapel</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Mapel</th>
                                        <th>Paket</th>
                                        <th>Kelompok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mapel as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_mapel }}</td>
                                            @if ($data->paket_id == 9)
                                                <td>{{ 'Semua' }}</td>
                                            @else
                                                <td>{{ $data->paket->ket }}</td>
                                            @endif
                                            <td>{{ $data->kelompok }}</td>
                                            <td>
                                                <form action="{{ route('mapel.kill', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('mapel.restore', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-success btn-sm mt-2"><i
                                                            class="nav-icon fas fa-undo"></i> &nbsp; Restore</a>
                                                    <button class="btn btn-danger btn-sm mt-2"><i
                                                            class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
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
        $("#TrashMapel").addClass("active");
    </script>
@endsection
