@extends('layouts.app')

@section('title')
    | Surat Keluar
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
            Transaksi 
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Surat Keluar</li>
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
                <h3 class="card-title">Surat Keluar</h3>
                <div class="card-tools"><button type="button" class="btn btn-block btn-outline-success btn-sm" data-toggle="modal" data-target="#create-sk">
                        <i class="far fa-plus-square"></i> Tambah Data Surat
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
                    <th>Perihal</th>
                    <th>Tujuan Surat</th>
                    <th>No. Surat</th>
                    <th width="70">Tgl Surat</th>
                    <th width="120">Lampiran</th>
                    <th width="40"><i class="fas fa-wrench"></i></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tsk as $item)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td>{{ $item->perihal }}</td>
                            <td>{{ $item->asal }}</td>
                            <td>{{ $item->no_surat }}</td>
                            <td>{{ date('j M Y', strtotime($item->tgl_surat)) }}</td>
                            <td align="center">
                                <a href="{{ route('tsk.file', $item->id ) }}">
                                    <b><i class="fa fa-file-download"></i> {{ $item->file }}</b>
                                </a>
                            </td>
                            <td align="center">
                                <a href="{{ url('tsk/'.$item->id) }}" class="btn bg-gradient-info btn-xs" title="Detail">
                                    <i class="fas fa-info-circle"></i> Detail
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


<form role="form" method="POST" action="{{ route('tsk.store') }}" enctype="multipart/form-data">
    @csrf
<div class="modal fade" id="create-sk">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Surat Keluar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kode_nomor_surat">Kode Nomor Surat</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="kode_nomor_surat">
                            <option selected="selected">{{ old('kode_nomor_surat') }}</option>
                            @foreach ($kd_nmr_surat as $item)
                                <option value="{{ $item->kode }}">{{ $item->kode }} - {{ $item->nama_kode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_surat">Nomor Surat</label>
                        <input type="text" class="form-control" placeholder="Enter nomor surat" name="no_surat" value="{{ old('no_surat') }}">
                    </div>
                    <div class="form-group">
                        <label for="tujuan">Tujuan Surat</label>
                        <input type="text" class="form-control" placeholder="Enter tujuan surat" name="tujuan" value="{{ old('tujuan') }}">
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" class="form-control" placeholder="Enter perihal" name="perihal" value="{{ old('perihal') }}">
                    </div>
                    <div class="form-group">
                        <label for="tgl_surat">Tanggal Surat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" name="tgl_surat" value="{{ old('tgl_surat') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_catat">Tanggal Catat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" name="tgl_catat" value="{{ old('tgl_catat') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Lampiran</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                            </div>
                        </div>
                        <small style="color:red">
                            *Format lampiran yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF
                        <br/>*Ukuran maksimal file 2 MB
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" placeholder="Enter keterangan">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Simpan</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</form>
@endsection

@section('script')
<!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- InputMask -->
<script src="{{asset('backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>

<!-- bs-custom-file-input -->
<script src="{{asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
</script>

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

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('yyyy-mm-dd', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()
    });
  </script>
@endsection