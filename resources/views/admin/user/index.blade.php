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
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        {{-- Error --}}
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
                            <h3 class="card-title">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target=".tambah-user"> Tambah Data User
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Level User</th>
                                        <th>Jumlah User</th>
                                        <th>Lihat User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $role => $data)
                                        <tr>
                                            <td>{{ $role }}</td>
                                            <td>{{ $data->count() }}</td>
                                            <td>
                                                <a href="{{ route('user.show', Crypt::encrypt($role)) }}"
                                                    class="btn btn-info">Detail</a>
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

    <!-- Extra large modal -->
    <div class="modal fade bd-example-modal-lg tambah-user" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" class="form-control" type="text"
                                        placeholder="{{ __('Name') }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="role">Level User</label>
                                    <select id="role" type="text"
                                        class="form-control @error('role') is-invalid @enderror select2bs4" name="role"
                                        value="{{ old('role') }}" autocomplete="role">
                                        <option value="">-- Select {{ __('Level User') }} --</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Operator">Operator</option>
                                        <option value="Guru">Guru</option>
                                        <option value="Siswa">Siswa</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3" id="noId">
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" placeholder="{{ __('Password') }}"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password_confirmation" autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal"> Kembali</button>
                    <button type="submit" class="btn btn-primary">
                        Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script>
        function inputAngka(e) {
            var charCode = (e.which) ? e.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function sikap(e) {
            var charCode = (e.which) ? e.which : event.keyCode
            if (charCode > 31 && (charCode < 49 || charCode > 52)) {
                return false;
            }
            return true;
        }
        $(document).ready(function() {
            $('#role').change(function() {
                var kel = $('#role option:selected').val();
                if (kel == "Guru") {
                    $("#noId").html(
                        '<label for="nomer">Nomer Id Card</label><input id="nomer" type="text" maxlength="5" onkeypress="return inputAngka(event)" placeholder="No Id Card" class="form-control" name="nomer" autocomplete="off">'
                    );
                } else if (kel == "Siswa") {
                    $("#noId").html(
                        `<label for="nomer">Nomer Induk Siswa</label><input id="nomer" type="text" placeholder="No Induk Siswa" class="form-control" name="nomer" autocomplete="off">`
                    );
                } else if (kel == "Admin" || kel == "Operator") {
                    $("#noId").html(
                        `<label for="name">Username</label><input id="name" type="text" placeholder="Username" class="form-control" name="name" autocomplete="off">`
                    );
                } else {
                    $("#noId").html("")
                }
            });
        });

        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataUser").addClass("active");
    </script>
@endpush
