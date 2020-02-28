@extends('layouts.app')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
            <li class="breadcrumb-item"><a href="{{ url('user') }}">User</a></li>
            <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-6">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Data User <b>{{ $user->nama }}</b></h3>
                <div class="card-tools">
                    @if(auth()->user()->id_role == 1)
                    <button type="button" class="btn btn-block btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit-user">
                        <i class="fas fa-edit"></i> Edit Data User
                    </button>
                    @elseif(auth()->user()->id_role == 2)
                    <button type="button" class="btn btn-block btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit-role">
                        <i class="fas fa-edit"></i> Edit Hak Akses
                    </button>
                    @endif
                </div>
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

            <form role="form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" value="{{ $user->nama }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input class="form-control" value="{{ $user->nip }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" value="{{ $user->username }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="role">Hak Akses</label>
                        <input class="form-control" value="{{ $user->nama_role }}" disabled>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<div class="modal fade" id="edit-user">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Data User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ url('user/'.$user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="role">
                                <option selected="selected" value="{{ $user->id_role }}">{{ $user->nama_role }}</option>
                                @foreach ($role as $item)
                                    <option value="{{$item->id}}">{{$item->nama_role}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" placeholder="Enter nama" name="nama" value="{{ $user->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" placeholder="Enter NIP" name="nip" value="{{ $user->nip }}">
                        </div>
                        <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" placeholder="Enter username" name="username" value="{{ $user->username }}">
                            </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                {{-- </form> --}}
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Simpan</button>
        </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="edit-role">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Hak Akses</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ url('user/'.$user->id.'/role') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="id_role">
                                <option selected="selected" value="{{ $user->id_role }}">{{ $user->nama_role }}</option>
                                @foreach ($role as $item)
                                    <option value="{{$item->id}}">{{$item->nama_role}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input class="form-control" value="{{ $user->nama }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input class="form-control" value="{{ $user->nip }}" disabled>
                        </div>
                        <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" value="{{ $user->username }}" disabled>
                            </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                    </div>
                    <!-- /.card-body -->
                {{-- </form> --}}
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Simpan</button>
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

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>
@endsection