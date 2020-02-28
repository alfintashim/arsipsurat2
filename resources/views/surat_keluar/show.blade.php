@extends('layouts.app')

@section('title')
    | Surat Keluar | {{ $tsk->no_surat }}
@endsection

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
            <h1>Transaksi</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tsk.index') }}">Surat Keluar</a></li>
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
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Surat Keluar - No. Surat <b>{{ $tsk->no_surat }}</b></h3>
                <div class="card-tools"></div>
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
                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit-sk">
                    <i class="fas fa-edit"></i> Edit Data Surat
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete-sk">
                    <i class="fas fa-trash"></i> Hapus Data Surat
                </button>
                <br>
                <br>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nomor Surat</label>
                                    <input class="form-control" value="{{ $tsk->no_surat }}" readonly>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Surat</label>
                                    <input class="form-control" value="{{ date('j M Y', strtotime($tsk->tgl_surat)) }}" readonly>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tujuan Surat</label>
                                    <input class="form-control" value="{{ $tsk->tujuan }}" readonly>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Perihal</label>
                                    <input class="form-control" value="{{ $tsk->perihal }}" readonly>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lampiran</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" value="{{ $tsk->file }}" readonly>
                                        <span class="input-group-append">
                                            <a href="{{ route('tsk.file', $tsk->id) }}" type="button" class="btn btn-info"><i class="fa fa-eye"></i> Lihat</a>
                                        </span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Catat</label>
                                    <input class="form-control" value="{{ date('j M Y', strtotime($tsk->tgl_catat)) }}" readonly>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $tsk->keterangan }}</textarea>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Petugas (Uploader)</label>
                                    <input class="form-control" value="{{ $tsk->nama }}" readonly>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<form role="form" method="POST" action="{{ route('tsk.destroy',$tsk->id) }}" enctype="multipart/form-data">
        @csrf
        @method('delete')
<div class="modal fade" id="delete-sk">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Surat {{ $tsk->no_surat }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
            <img src="{{ url('img/warning-icon.png') }}" style="width:120px;height:120px" alt="">
            <p>Apakah anda yakin ingin menghapus data surat {{ $tsk->no_surat }}?</p>
            <small style="color:red">Data yang sudah dihapus tidak dapat dikembalikan.</small>
            </center>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn bg-gradient-danger"><i class="fa fa-trash"> </i> Hapus</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</form>


<div class="modal fade" id="edit-sk">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Data Surat {{ $tsk->no_surat }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('tsk.update',$tsk->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kode_nomor_surat">Kode Nomor Surat</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="kode_nomor_surat">
                                <option selected="selected">{{ $tsk->id_kns }}</option>
                                @foreach ($kd_nmr_surat as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama_kode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_surat">Nomor Surat</label>
                            <input type="text" class="form-control" name="no_surat" value="{{ $tsk->no_surat }}">
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Tujuan Surat</label>
                            <input type="text" class="form-control" name="tujuan" value="{{ $tsk->tujuan }}">
                        </div>
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="text" class="form-control" name="perihal" value="{{ $tsk->perihal }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_surat">Tanggal Surat</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="tgl_surat" value="{{ $tsk->tgl_surat }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tgl_catat">Tanggal Catat</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="tgl_catat" value="{{ $tsk->tgl_catat }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Lampiran</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="exampleInputFile" value="{{ $tsk->file }}">
                                    <label class="custom-file-label" for="exampleInputFile">{{ $tsk->file }}</label>
                                </div>
                            </div>
                            <small style="color:red">
                                *Format lampiran yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF
                            <br/>*Ukuran maksimal file 2 MB
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan">{{ $tsk->keterangan }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                {{-- </form> --}}
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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

<!-- InputMask -->
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>

<!-- bs-custom-file-input -->
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
</script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
        //Money Euro
        $('[data-mask]').inputmask()
    });
  </script>
@endsection