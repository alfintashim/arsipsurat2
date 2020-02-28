@extends('layouts.app')

@section('title')
    | Master User
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
            User 
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">User</li>
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
                <h3 class="card-title">Daftar User</h3>
                <div class="card-tools"><button type="button" class="btn btn-block btn-outline-success btn-sm" data-toggle="modal" data-target="#create-user">
                        <i class="fas fa-user-plus"></i> Tambah User
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
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Level Akses</th>
                    <th width="70"><i class="fas fa-wrench"></i></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nip }}</td>
                            <td>{{ $item->email }}</td>
                            <td align="center"><span class="badge bg-navy">{{ $item->nama_role }}</span></td>
                            <td align="center">
                                <a href="{{ url('user/'.$item->id) }}" class="btn bg-gradient-info btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                                {{-- <a href="{{ url('user/'.$item->id.'/edit') }}" class="btn bg-gradient-primary btn-sm" type="button" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a> --}}
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

<div class="modal fade" id="create-user">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="role">Level Akses</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="role">
                                <option selected="selected">{{ old('role') }}</option>
                                @foreach ($role as $item)
                                    <option value="{{$item->id}}">{{$item->nama_role}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" placeholder="Enter nama" name="nama" value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" placeholder="Enter NIP" name="nip" value="{{ old('nip') }}">
                        </div>
                        <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" placeholder="Enter username" name="username" value="{{ old('username') }}">
                            </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="{{ old('password') }}">
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
<!-- Select2 -->
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

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