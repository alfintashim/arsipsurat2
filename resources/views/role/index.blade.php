@extends('layouts.app')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
            Level Akses 
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Level Akses</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-10">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Level Akses</h3>
                <div class="card-tools"><button type="button" class="btn btn-block btn-outline-success btn-sm" data-toggle="modal" data-target="#create-role">
                        <i class="fas fa-user-plus"></i> Tambah Level Akses
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
                    <th width="20">No.</th>
                    <th>Nama Level Akses</th>
                    <th>Keterangan</th>
                    {{-- <th width="70"><i class="fas fa-wrench"></i></th> --}}
                </tr>
                </thead>
                <tbody>
                    @foreach ($role as $item)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $item->nama_role }}</td>
                            <td>{{ $item->ket }}</td>
                            {{-- <td align="center">
                                <button class="btn bg-gradient-info btn-sm" type="button" title="Edit"  data-toggle="modal" data-target="#edit-role">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td> --}}
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

<div class="modal fade" id="create-role">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Level Akses</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('role.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_role">Nama Level Akses</label>
                            <input type="text" class="form-control" placeholder="Enter nama Level akses" name="nama_role" value="{{ old('nama_role') }}">
                        </div>
                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <input type="text" class="form-control" placeholder="Enter keterangan" name="ket" value="{{ old('ket') }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                {{-- </form> --}}
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
    });
</script>
@endsection