@extends('layouts.app')

@section('title')
    | Profil
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
            Profil 
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Profil</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{url('/img/logo/'.$profil->logo)}}"
                       alt="Logo Instansi">
                </div>

                <h3 class="profile-username text-center">{{ $profil->nama }}</h3>

                <p class="text-muted text-center">{{ $profil->status }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
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
                    <button type="button" class="btn btn-block btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit-profil">
                        <i class="fas fa-edit"></i> Edit Data Profil
                    </button>
                </div>
                <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-user-tie mr-1"></i> Nama Kepala</strong>

                <p class="text-muted">{{ $profil->ketua }}</p>

                <hr>

                <strong><i class="fas fa-id-card mr-1"></i> NIP</strong>

                <p class="text-muted">{{ $profil->nip }}</p>

                <hr>

                <strong><i class="fas fa-at mr-1"></i> Email</strong>

                <p class="text-muted">{{ $profil->email }}</p>

                <hr>

                <strong><i class="fas fa-map-marked-alt mr-1"></i> Alamat</strong>

                <p class="text-muted">{{ $profil->alamat }}</p>

                <hr>

                <strong><i class="fas fa-globe mr-1"></i> Website</strong>

                <p class="text-muted">{{ $profil->website }}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>

<div class="modal fade" id="edit-profil">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Data Profil</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ url('profil/'.$profil->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Instansi</label>
                            <input type="text" class="form-control" name="nama" value="{{ $profil->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="kepala">Nama Kepala</label>
                            <input type="text" class="form-control" name="kepala" value="{{ $profil->ketua }}">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" name="nip" value="{{ $profil->nip }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $profil->email }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" name="status" value="{{ $profil->status }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat">{{ $profil->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" name="website" value="{{ $profil->website }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input" id="exampleInputFile" value="{{ $profil->logo }}">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                                </div>
                            </div>
                            <small style="color:red">
                                *Format lampiran yang diperbolehkan *.JPG, *.PNG
                            <br/>*Ukuran maksimal file 2 MB
                            </small>
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