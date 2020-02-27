@extends('layouts.app')

@section('title')
    | Master Kode Nomor Surat
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
            Kode Nomor Surat 
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Kode Nomor Surat</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kode Nomor Surat</h3>
                <div class="card-tools"><button type="button" class="btn btn-block btn-outline-success btn-sm" data-toggle="modal" data-target="#create-kode">
                        <i class="fas fa-user-plus"></i> Tambah Kode
                    </button></div>
            </div>
            <!-- /.card-header -->

            {{-- menampilkan error validasi --}}
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr align="center">
                    <th width="40">Kode</th>
                    <th>Nama Kode</th>
                    <th>Kategori</th>
                    <th width="50"><i class="fas fa-wrench"></i></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($kd_nmr_surat as $item)
                        <tr>
                            <td align="center">{{ $item->kode }}</td>
                            <td>{{ $item->nama_kode }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td align="center">
                                <a href="{{ url('kns/'.$item->id.'/edit') }}" class="btn bg-gradient-primary btn-sm" type="button" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<div class="modal fade" id="create-kode">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Kode Nomor Surat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ url('kns/create') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" placeholder="Enter Kode" name="kode" value="{{ old('kode') }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_kode">Nama Kode</label>
                            <input type="text" class="form-control" placeholder="Enter nama kode" name="nama_kode" value="{{ old('nama_kode') }}">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="kategori">
                                <option selected="selected">{{ old('kategori') }}</option>
                                <option>UMUM</option>
                                <option>PEMERINTAHAN</option>
                                <option>POLITIK</option>
                                <option>KEAMANAN/KETERTIBAN</option>
                                <option>KESEJAHTERAAN RAKYAT</option>
                                <option>PEREKONOMIAN</option>
                                <option>PEKERJAAN UMUM & KETENAGAAN</option>
                                <option>PENGAWASAN</option>
                                <option>KEPEGAWAIAN</option>
                                <option>KEUANGAN</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Simpan</button>
        </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@section('script')
<!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>

<script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
  </script>
@endsection