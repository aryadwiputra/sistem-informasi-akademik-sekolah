@extends('layouts.admin')

@section('title', 'Data User')

@php
    $headerData = [
        'pretitle' => 'Data User',
        'title' => 'Data User',
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
                        {{-- If success --}}
                        @if (session('success'))
                            <div class="alert alert-success mb-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mb-3">
                                {{ session('error') }}
                            </div>
                        @endif
                        {{-- Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('user.index') }}" class="btn btn-default">Kembali</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        @foreach ($role as $d => $data)
                                            @if ($d == 'Guru')
                                                <th>No Id Card</th>
                                            @elseif ($d == 'Siswa')
                                                <th>No Induk Siswa</th>
                                            @else
                                            @endif
                                        @endforeach
                                        {{-- <th>Tanggal Register</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user->count() > 0)
                                        @foreach ($user as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-capitalize">{{ $data->name }}</td>
                                                <td>{{ $data->email }}</td>
                                                @if ($data->role == 'Siswa')
                                                    <td>{{ $data->no_induk }}</td>
                                                @elseif ($data->role == 'Guru')
                                                    <td>{{ $data->id_card }}</td>
                                                @else
                                                @endif
                                                {{-- <td>{{ $data->created_at->format('l, d F Y') }}</td> --}}
                                                <td>
                                                    <form action="{{ route('user.destroy', $data->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan='5'
                                                style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>
                                                Silahkan Buat Akun Terlebih Dahulu!</td>
                                        </tr>
                                    @endif
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
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataUser").addClass("active");
    </script>
@endsection
