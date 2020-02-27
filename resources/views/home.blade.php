@extends('layouts.app')

@section('content')
<section class="content">
  <div class="container-fluid">
    <br>

    <div class="info-box mb-3">
      <!-- Profile Image -->
      {{-- <div class="card card-primary card-outline"> --}}
        <div class="card-body box-profile">
          <div class="text-center">
            <img src="{{url('/img/logo/'.$profil->logo)}}" alt="{{ $profil->nama }}" width="15%">
          </div>

          <h4 class="text-center"><b>{{ $profil->nama }}</b></h4>

          <h5 class="text-center">{{ $profil->status }}</h5>
          <h5 class="text-center">{{ $profil->alamat }}</h5>
          <h5 class="text-center"><i class="fa fa-at"></i> {{ $profil->email }} <i class="fa fa-globe"></i> {{ $profil->website }}</h5>
        </div>
        <!-- /.card-body -->
      {{-- </div> --}}
      <!-- /.card -->
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- small box -->
        <div class="small-box bg-teal">
          <div class="inner">
            <center>
            <h3>Selamat datang <b>{{ Auth::user()->nama }}</b></h3>
            </center>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-envelope-open-text"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Surat Masuk</span>
            <span class="info-box-number">
              {{ $sm }}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-envelope-open-text"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Surat Keluar</span>
            <span class="info-box-number">{{ $sk }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-tasks"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Disposisi</span>
            <span class="info-box-number">{{ $disposisi }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Selesai</span>
            <span class="info-box-number">{{ $selesai }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection