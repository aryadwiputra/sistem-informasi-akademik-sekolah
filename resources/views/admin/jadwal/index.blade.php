@extends('layouts.admin')

@section('title', 'Jadwal')

@php
    $headerData = [
        'pretitle' => 'Jadwal',
        'title' => 'Jadwal',
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
                                {{-- <button type="button" class="btn btn-default" data-toggle="modal"
                                    data-target=".tambah-jadwal">
                                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Jadwal
                                </button> --}}
                                <a href="{{ route('jadwal.export_excel') }}" class="btn btn-success my-3"
                                    target="_blank">Export Excel</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#importExcel">Import Excel
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#dropTable">Drop
                                </button>
                            </h3>
                        </div>
                        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{ route('jadwal.import_excel') }}"
                                    enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <div class="card card-outline card-primary">
                                                <div class="card-header">
                                                    <h5 class="modal-title">Petunjuk :</h5>
                                                </div>
                                                <div class="card-body">
                                                    <ul>
                                                        <li>rows 1 = nama hari</li>
                                                        <li>rows 2 = nama kelas</li>
                                                        <li>rows 3 = nama mapel</li>
                                                        <li>rows 4 = nama guru</li>
                                                        <li>rows 5 = jam mulai</li>
                                                        <li>rows 6 = jam selesai</li>
                                                        <li>rows 7 = nama ruang</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <label>Pilih file excel</label>
                                            <div class="mb-3">
                                                <input type="file" name="file" required="required">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="dropTable" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{ route('jadwal.deleteAll') }}">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sure you drop all data?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cencel</button>
                                            <button type="submit" class="btn btn-danger">Drop</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kelas</th>
                                        <th>Lihat Jadwal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_kelas }}</td>
                                            <td>
                                                <a href="{{ route('jadwal.show', Crypt::encrypt($data->id)) }}"
                                                    class="btn btn-info">
                                                    Detail</a>
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
    {{-- Modal --}}
    <div class="modal modal-blur fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jadwal.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hari_id">Hari</label>
                                    <select id="hari_id" name="hari_id"
                                        class="form-control @error('hari_id') is-invalid @enderror select2bs4">
                                        <option value="">-- Pilih Hari --</option>
                                        @foreach ($hari as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_hari }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kelas_id">Kelas</label>
                                    <select id="kelas_id" name="kelas_id"
                                        class="form-control @error('kelas_id') is-invalid @enderror select2bs4">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="guru_id">Kode Mapel</label>
                                    <select id="guru_id" name="guru_id"
                                        class="form-control @error('guru_id') is-invalid @enderror select2bs4">
                                        <option value="">-- Pilih Kode Mapel --</option>
                                        @foreach ($guru as $data)
                                            <option value="{{ $data->id }}">{{ $data->kode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type='text' id="jam_mulai" name='jam_mulai'
                                        class="form-control @error('jam_mulai') is-invalid @enderror jam_mulai"
                                        placeholder="{{ Date('H:i') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="jam_selesai">Jam Selesai</label>
                                    <input type='text' id="jam_selesai" name='jam_selesai'
                                        class="form-control @error('jam_selesai') is-invalid @enderror"
                                        placeholder="{{ Date('H:i') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="ruang_id">Ruang Kelas</label>
                                    <select id="ruang_id" name="ruang_id"
                                        class="form-control @error('ruang_id') is-invalid @enderror select2bs4">
                                        <option value="">-- Pilih Ruang Kelas --</option>
                                        @foreach ($ruang as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_ruang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Simpan
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('after-scripts')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataJadwal").addClass("active");
        $("#jam_mulai,#jam_selesai").timepicker({
            timeFormat: 'HH:mm'
        });
    </script>
@endpush
