@extends('layouts.admin')

@section('title', 'Mata Pelajaran')

@php
    $headerData = [
        'pretitle' => 'Mata Pelajaran',
        'title' => 'Mata Pelajaran',
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Tambah Data
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Mapel</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mapel as $result => $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_mapel }}</td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('mapel.edit', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-success">
                                                        Edit</a>

                                                    <form id="delete-form-{{ $data->id }}"
                                                        action="{{ route('mapel.destroy', $data->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-danger"
                                                            onclick="deleteMapel('{{ $data->id }}')">Hapus</a>
                                                    </form>
                                                </div>
                                            </td>
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


@endsection

@push('additional-modals')
    <div class="modal modal-blur fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mapel.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="nama_mapel">Nama Mata Pelajaran</label>
                                    <input type="text" id="nama_mapel" name="nama_mapel"
                                        class="form-control @error('nama_mapel') is-invalid @enderror"
                                        placeholder="{{ __('Nama Mata Pelajaran') }}">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">
                        Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('after-scripts')
    <script>
        function deleteMapel(id) {
            Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data akan dihapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya!"
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Submit form untuk menghapus data
                        document.getElementById('delete-form-' + id).submit();
                    } else {
                        // Tidak melakukan apa-apa
                    }
                });
        }
    </script>


    <!-- Tambahkan script untuk menampilkan pesan Toastr -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Sukses",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif

    @if (session('error'))
        <script></script>
    @endif
@endpush
