@extends('layouts.admin')

@section('title', 'Data Kelas')

@php
    $headerData = [
        'pretitle' => 'Kelas',
        'title' => 'Data Kelas',
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
                            {{-- Error --}}
                            <h3 class="card-title">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#form-kelas">Tambah Data Kelas
                                </button>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kelas</th>
                                        <th>Wali Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_kelas }}</td>
                                            <td>{{ $data->guru->nama_guru }}</td>
                                            <td>
                                                <form action="{{ route('kelas.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-info"
                                                        onclick="getSubsSiswa({{ $data->id }})" data-bs-toggle="modal"
                                                        data-bs-target=".view-siswa">View Siswa
                                                    </button>
                                                    <button type="button" class="btn btn-info"
                                                        onclick="getSubsJadwal({{ $data->id }})" data-bs-toggle="modal"
                                                        data-bs-target=".view-jadwal"> View Jadwal
                                                    </button>
                                                    <button type="button" class="btn btn-success"
                                                        onclick="getEditKelas({{ $data->id }})" data-bs-toggle="modal"
                                                        data-bs-target="#form-kelas">Edit
                                                    </button>
                                                    <button class="btn btn-danger"> Hapus</button>
                                                </form>
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
    <!-- Extra large modal -->
    <div class="modal modal-blur fade" id="form-kelas" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="judul">Tambah Kelas</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kelas.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="id" name="id">
                                <div class="mb-3" id="form_nama">
                                    <label class="form-label" for="nama_kelas">Kelas</label>
                                    <input type="text" id="nama_kelas" name="nama_kelas"
                                        class="form-control @error('nama_kelas') is-invalid @enderror"
                                        placeholder="Masukan Nama Kelas">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="guru_id">Wali Kelas</label>
                                    <select id="guru_id" name="guru_id"
                                        class="select2bs4 form-control @error('guru_id') is-invalid @enderror">
                                        <option value="">-- Pilih Wali Kelas --</option>
                                        @foreach ($guru as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_guru }}</option>
                                        @endforeach
                                    </select>
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


    <!-- Extra large modal -->
    <div class="modal modal-blur fade view-siswa" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="judul-siswa">View Siswa</h4>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No Induk Siswa</th>
                                            <th>Nama Siswa</th>
                                            <th>L/P</th>
                                            <th>Foto Siswa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-siswa">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No Induk Siswa</th>
                                            <th>Nama Siswa</th>
                                            <th>L/P</th>
                                            <th>Foto Siswa</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Kembali</button>
                    <a id="link-siswa" href="#" class="btn btn-primary">Download PDF</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra large modal -->
    <div class="modal modal-blur fade view-jadwal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="judul-jadwal">View Jadwal</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Jadwal</th>
                                            <th>Jam Pelajaran</th>
                                            <th>Ruang Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-jadwal">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Jadwal</th>
                                            <th>Jam Pelajaran</th>
                                            <th>Ruang Kelas</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal"> Kembali</button>
                    <a id="link-jadwal" href="#" class="btn btn-primary">Download PDF</a>
                </div>
            </div>
        </div>
    @endsection

    @push('after-scripts')
        {{-- jquery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            function getEditKelas(id) {
                var parent = id;
                $.ajax({
                    type: "GET",
                    data: "id=" + parent,
                    dataType: "JSON",
                    url: "{{ url('/kelas/edit/json') }}",
                    success: function(result) {
                        // console.log(result);
                        if (result) {
                            $.each(result, function(index, val) {
                                $("#judul").text('Edit Data Kelas ' + val.nama);
                                $('#id').val(val.id);
                                $('#nama_kelas').val(val.nama);
                                $("#paket_id").val(val.paket_id);
                                $('#guru_id').val(val.guru_id);
                            });
                        }
                    },
                    error: function() {},
                    complete: function() {}
                });
            }

            function getSubsSiswa(id) {
                var parent = id;
                $.ajax({
                    type: "GET",
                    data: "id=" + parent,
                    dataType: "JSON",
                    url: "{{ url('/siswa/view/json') }}",
                    success: function(result) {
                        // console.log(result);
                        var siswa = "";
                        if (result) {
                            $.each(result, function(index, val) {
                                $("#judul-siswa").text('View Data Siswa ' + val.kelas);
                                siswa += "<tr>";
                                siswa += "<td>" + val.no_induk + "</td>";
                                siswa += "<td>" + val.nama_siswa + "</td>";
                                siswa += "<td>" + val.jk + "</td>";
                                siswa += "<td><img src='" + val.foto + "' width='100px'></td>";
                                siswa += "</tr>";
                            });
                            $("#data-siswa").html(siswa);
                        }
                    },
                    error: function() {},
                    complete: function() {}
                });
                $("#link-siswa").attr("href", "{{ url('listsiswapdf/') }}" + id);
            }

            function getSubsJadwal(id) {
                var parent = id;
                $.ajax({
                    type: "GET",
                    data: "id=" + parent,
                    dataType: "JSON",
                    url: "{{ url('/jadwal/view/json') }}",
                    success: function(result) {
                        // console.log(result);
                        var jadwal = "";
                        if (result) {
                            $.each(result, function(index, val) {
                                $("#judul-jadwal").text('View Data Jadwal ' + val.kelas);
                                jadwal += "<tr>";
                                jadwal += "<td>" + val.hari + "</td>";
                                jadwal += "<td><h5 class='card-title'>" + val.mapel +
                                    "</h5><p class='card-text'><small class='text-muted'>" + val.guru +
                                    "</small></p></td>";
                                jadwal += "<td>" + val.jam_mulai + " - " + val.jam_selesai + "</td>";
                                jadwal += "<td>" + val.ruang + "</td>";
                                jadwal += "</tr>";
                            });
                            $("#data-jadwal").html(jadwal);
                        }
                    },
                    error: function() {},
                    complete: function() {}
                });
                $("#link-jadwal").attr("href", "{{ url('jadwalkelaspdf/') }}" + id);
            }

            $("#MasterData").addClass("active");
            $("#liMasterData").addClass("menu-open");
            $("#DataKelas").addClass("active");
        </script>
    @endpush

    {{-- @section('script')
    <script>
        function getCreateKelas() {
            $("#judul").text('Tambah Data Kelas');
            $('#id').val('');
            $('#form_nama').html(`
        <label for="nama_kelas">Nama Kelas</label>
        <input type='text' id="nama_kelas" onkeyup="this.value = this.value.toUpperCase()" name='nama_kelas' class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="{{ __('Nama Kelas') }}">
      `);
            $('#nama_kelas').val('');
            $('#form_paket').html('');
            $('#form_paket').html(`
        <label for="paket_id">Paket Keahlian</label>
        <select id="paket_id" name="paket_id" class="select2bs4 form-control @error('paket_id') is-invalid @enderror">
          <option value="">-- Pilih Paket Keahlian --</option>
          @foreach ($paket as $data)
            <option value="{{ $data->id }}">{{ $data->ket }}</option>
          @endforeach
        </select>
      `);
            $('#guru_id').val('');
        }

        function getEditKelas(id) {
            var parent = id;
            var form_paket = (`
        <input type="hidden" id="paket_id" name="paket_id">
        <input type="hidden" id="nama_kelas" name="nama_kelas">
      `);
            $.ajax({
                type: "GET",
                data: "id=" + parent,
                dataType: "JSON",
                url: "{{ url('/kelas/edit/json') }}",
                success: function(result) {
                    // console.log(result);
                    if (result) {
                        $.each(result, function(index, val) {
                            $("#judul").text('Edit Data Kelas ' + val.nama);
                            $('#id').val(val.id);
                            $('#form_nama').html('');
                            $('#form_paket').html('');
                            $("#form_paket").append(form_paket);
                            $('#nama_kelas').val(val.nama);
                            $("#paket_id").val(val.paket_id);
                            $('#guru_id').val(val.guru_id);
                        });
                    }
                },
                error: function() {
                    toastr.error("Errors 404!");
                },
                complete: function() {}
            });
        }

        function getSubsSiswa(id) {
            var parent = id;
            $.ajax({
                type: "GET",
                data: "id=" + parent,
                dataType: "JSON",
                url: "{{ url('/siswa/view/json') }}",
                success: function(result) {
                    // console.log(result);
                    var siswa = "";
                    if (result) {
                        $.each(result, function(index, val) {
                            $("#judul-siswa").text('View Data Siswa ' + val.kelas);
                            siswa += "<tr>";
                            siswa += "<td>" + val.no_induk + "</td>";
                            siswa += "<td>" + val.nama_siswa + "</td>";
                            siswa += "<td>" + val.jk + "</td>";
                            siswa += "<td><img src='" + val.foto + "' width='100px'></td>";
                            siswa += "</tr>";
                        });
                        $("#data-siswa").html(siswa);
                    }
                },
                error: function() {
                    toastr.error("Errors 404!");
                },
                complete: function() {}
            });
            $("#link-siswa").attr("href", "https://siakad.didev.id/listsiswapdf/" + id);
        }

        function getSubsJadwal(id) {
            var parent = id;
            $.ajax({
                type: "GET",
                data: "id=" + parent,
                dataType: "JSON",
                url: "{{ url('/jadwal/view/json') }}",
                success: function(result) {
                    // console.log(result);
                    var jadwal = "";
                    if (result) {
                        $.each(result, function(index, val) {
                            $("#judul-jadwal").text('View Data Jadwal ' + val.kelas);
                            jadwal += "<tr>";
                            jadwal += "<td>" + val.hari + "</td>";
                            jadwal += "<td><h5 class='card-title'>" + val.mapel +
                                "</h5><p class='card-text'><small class='text-muted'>" + val.guru +
                                "</small></p></td>";
                            jadwal += "<td>" + val.jam_mulai + " - " + val.jam_selesai + "</td>";
                            jadwal += "<td>" + val.ruang + "</td>";
                            jadwal += "</tr>";
                        });
                        $("#data-jadwal").html(jadwal);
                    }
                },
                error: function() {
                    toastr.error("Errors 404!");
                },
                complete: function() {}
            });
            $("#link-jadwal").attr("href", "https://siakad.didev.id/jadwalkelaspdf/" + id);
        }

        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataKelas").addClass("active");
    </script>
@endsection --}}
