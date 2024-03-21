@extends('layouts.admin')
@section('title', 'Data Guru')
@php
    $headerData = [
        'pretitle' => 'Guru',
        'title' => 'Data Guru',
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" class="btn btn-default" data-bs-toggle="modal"
                                    data-bs-target="#tambahDataGuru">Tambah Data Guru
                                </button>
                                <a href="{{ route('guru.export_excel') }}" class="btn btn-success  my-3"
                                    target="_blank">Export Excel</a>
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#importExcel"> Import Excel
                                </button>
                                <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                    data-bs-target="#dropTable">
                                    Drop
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Kode Jadwal</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nip }}</td>
                                            <td>{{ $data->nama_guru }}</td>
                                            <td>{{ $data->kode }}</td>
                                            <td>{{ $data->jk }}</td>
                                            <td>{{ $data->telp }}</td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    {{-- Detail --}}
                                                    <a href="{{ route('guru.show', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-success">Detail</a>
                                                    <a href="{{ route('guru.edit', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-info ">
                                                        Edit</a>
                                                    <form id="delete-form-{{ $data->id }}"
                                                        action="{{ route('guru.destroy', $data->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="btn btn-danger"
                                                            onclick="deleteGuru('{{ $data->id }}')">Hapus</a>
                                                    </form>
                                                </div>
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
    {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true"> --}}
@endsection

@push('additional-modals')
    {{-- tambah data guru --}}
    <div class="modal modal-blur fade" id="tambahDataGuru" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Guru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guru.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_guru">Nama Guru</label>
                                    <input type="text" id="nama_guru" name="nama_guru"
                                        class="form-control @error('nama_guru') is-invalid @enderror">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="tmp_lahir">Tempat Lahir</label>
                                    <input type="text" id="tmp_lahir" name="tmp_lahir"
                                        class="form-control @error('tmp_lahir') is-invalid @enderror">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir"
                                        class="form-control @error('tgl_lahir') is-invalid @enderror">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="jk">Jenis Kelamin</label>
                                    <select id="jk" name="jk"
                                        class="select2bs4 form-control @error('jk') is-invalid @enderror">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="telp">Nomor Telpon/HP</label>
                                    <input type="text" id="telp" name="telp"
                                        onkeypress="return inputAngka(event)"
                                        class="form-control @error('telp') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nip">NIP</label>
                                    <input type="text" id="nip" name="nip"
                                        onkeypress="return inputAngka(event)"
                                        class="form-control @error('nip') is-invalid @enderror">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="mapel_id">Mapel</label>
                                    <select id="mapel_id" name="mapel_id"
                                        class="select2bs4 form-control @error('mapel_id') is-invalid @enderror">
                                        <option value="">-- Pilih Mapel --</option>
                                        @foreach ($mapel as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @php
                                    $kode = $max + 1;
                                    if (strlen($kode) == 1) {
                                        $id_card = '0000' . $kode;
                                    } elseif (strlen($kode) == 2) {
                                        $id_card = '000' . $kode;
                                    } elseif (strlen($kode) == 3) {
                                        $id_card = '00' . $kode;
                                    } elseif (strlen($kode) == 4) {
                                        $id_card = '0' . $kode;
                                    } else {
                                        $id_card = $kode;
                                    }
                                @endphp
                                <div class="mb-3">
                                    <label class="form-label" for="id_card">Nomor ID Card</label>
                                    <input type="text" id="id_card" name="id_card" maxlength="5"
                                        onkeypress="return inputAngka(event)" value="{{ $id_card }}"
                                        class="form-control @error('id_card') is-invalid @enderror" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="kode">Kode Jadwal Guru</label>
                                    <input type="text" id="kode" name="kode" maxlength="3"
                                        onkeyup="this.value = this.value.toUpperCase()"
                                        class="form-control @error('kode') is-invalid @enderror">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="foto">Foto</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="foto"
                                                class="form-control @error('foto') is-invalid @enderror" id="foto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Kembali</button>
                    <button type="submit" class="btn btn-primary">
                        Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Import --}}
    <div class="modal modal-blur fade" id="importExcel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('guru.import_excel') }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="card card-outline mb-3">
                            <div class="card-header">
                                <h5 class="modal-title">Petunjuk :</h5>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>rows 1 = nama guru</li>
                                    <li>rows 2 = nip guru</li>
                                    <li>rows 3 = jenis kelamin</li>
                                    <li>rows 4 = mata pelajaran</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih file excel</label>
                            <input type="file" class="form-control" name="file" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Drop --}}
    <div class="modal modal-blur fade" id="dropTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('guru.deleteAll') }}">
                @csrf
                @method('delete')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sure you drop all data?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Drop</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endpush


@push('after-scripts')
    <script>
        function deleteGuru(id) {
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
