@extends('layouts.app')

@section('title')
    | Surat Masuk | {{ $tsm->no_surat }}
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
            <li class="breadcrumb-item"><a href="{{ route('tsm.index') }}">Surat Masuk</a></li>
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
                <h3 class="card-title">Surat Masuk - No. Surat <b>{{ $tsm->no_surat }}</b></h3>
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
                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit-sm">
                    <i class="fas fa-edit"></i> Edit Data Surat
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete-sm">
                    <i class="fas fa-trash"></i> Hapus Data Surat
                </button>
                <br>
                <br>
                <h5>Status : 
                @if($tsm->status == 'DIKIRIM')
                    <span class="badge bg-blue">{{ $tsm->status }}</span> 
                    <br>Kepada : <b>Kelapa dan Sekcam</b>
                    <br>Kondisi : <b>{{ ($tsm->read == true) ? 'Belum dibaca' : 'Sudah dibaca' }}</b>
                @elseif($tsm->status == 'DISPOSISI')
                    <span class="badge bg-orange">{{ $tsm->status }}</span>
                @elseif($tsm->status == 'SELESAI')
                    <span class="badge bg-green">{{ $tsm->status }}</span>
                @endif
                </h5>
                <br>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-detail-tab" data-toggle="pill" href="#custom-tabs-three-detail" role="tab" aria-controls="custom-tabs-three-detail" aria-selected="true">Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-disposisi-tab" data-toggle="pill" href="#custom-tabs-three-disposisi" role="tab" aria-controls="custom-tabs-three-disposisi" aria-selected="false">Disposisi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-riwayat-tab" data-toggle="pill" href="#custom-tabs-three-riwayat" role="tab" aria-controls="custom-tabs-three-riwayat" aria-selected="false">Riwayat</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-three-detail" role="tabpanel" aria-labelledby="custom-tabs-three-detail-tab">
                            <form role="form">
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nomor Surat</label>
                                        <input class="form-control" value="{{ $tsm->no_surat }}" readonly>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tanggal Surat</label>
                                        <input class="form-control" value="{{ date('j M Y', strtotime($tsm->tgl_surat)) }}" readonly>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Asal Surat</label>
                                        <input class="form-control" value="{{ $tsm->asal }}" readonly>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Perihal</label>
                                        <input class="form-control" value="{{ $tsm->perihal }}" readonly>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Lampiran</label>
                                        <div class="input-group mb-3">
                                            <input class="form-control" value="{{ $tsm->file }}" readonly>
                                            <span class="input-group-append">
                                                <a href="{{ route('tsm.file', $tsm->id) }}" type="button" class="btn btn-info"><i class="fa fa-eye"></i> Lihat</a>
                                            </span>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tanggal Diterima</label>
                                        <input class="form-control" value="{{ date('j M Y', strtotime($tsm->tgl_diterima)) }}" readonly>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" rows="3" readonly>{{ $tsm->keterangan }}</textarea>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Petugas (Uploader)</label>
                                        <input class="form-control" value="{{ $tsm->nama }}" readonly>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-three-disposisi" role="tabpanel" aria-labelledby="custom-tabs-three-disposisi-tab">
                            @if(!empty($disposisi))
                                <form role="form">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Disposisi dari</label>
                                            <input class="form-control" value="{{ $disposisi->id_sm }}" readonly>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Disposisi ke</label>
                                            <input class="form-control" value="" readonly>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Catatan Disposisi</label>
                                            <textarea class="form-control" rows="3" readonly></textarea>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tanggal Disposisi</label>
                                            <input class="form-control" value="" readonly>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <h5><span class="badge bg-warning"><b>Surat belum disposisi</b></span></h5>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-three-riwayat" role="tabpanel" aria-labelledby="custom-tabs-three-riwayat-tab">
                            <div class="col-md-6">
                                <div class="timeline">
                                    @foreach ($log as $item)
                                        <div>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> {{ $item->created_at }}</span>
                                                @if ($item->status == 'DIKIRIM' && $item->read == NULL)
                                                    <h3 class="timeline-header no-border">Surat <span class="badge bg-blue">{{ $item->status }}</span> ke Kepala dan Sekcam.</h3>
                                                @elseif ($item->status == 'DIKIRIM' && $item->read == 'DIBACA')
                                                    <h3 class="timeline-header no-border">Surat telah <span class="badge bg-navy">{{ $item->read }}</span> oleh {{ $item->nama }}.</h3>
                                                @elseif ($item->status == 'DISPOSISI' && $item->read == NULL)
                                                    <h3 class="timeline-header no-border">Surat telah <span class="badge bg-orange">{{ $item->status }}</span> ke {{ $item->disp_ke }}.</h3>
                                                @elseif ($item->status == 'DISPOSISI' && $item->read == 'DIBACA')
                                                    <h3 class="timeline-header no-border">Disposisi telah <span class="badge bg-navy">{{ $item->read }}</span> oleh {{ $item->nama }}.</h3>
                                                @elseif ($item->status == 'SELESAI' && $item->read == NULL)
                                                    <h3 class="timeline-header no-border">Disposisi telah <span class="badge bg-green">{{ $item->status }}</span> oleh {{ $item->nama }}.</h3>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<form role="form" method="POST" action="{{ route('tsm.destroy',$tsm->id) }}" enctype="multipart/form-data">
        @csrf
        @method('delete')
    <div class="modal fade" id="delete-sm">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data Surat {{ $tsm->no_surat }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                <img src="{{ url('img/warning-icon.png') }}" style="width:120px;height:120px" alt="">
                <p>Apakah anda yakin ingin menghapus data surat {{ $tsm->no_surat }}?</p>
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


<form role="form" method="POST" action="{{ route('tsm.update', $tsm->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <div class="modal fade" id="edit-sm">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Surat {{ $tsm->no_surat }}</h4>
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
                                <option selected="selected">{{ $tsm->id_kns }}</option>
                                @foreach ($kd_nmr_surat as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama_kode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_surat">Nomor Surat</label>
                            <input type="text" class="form-control" name="no_surat" value="{{ $tsm->no_surat }}">
                        </div>
                        <div class="form-group">
                            <label for="asal">Asal Surat</label>
                            <input type="text" class="form-control" name="asal" value="{{ $tsm->asal }}">
                        </div>
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="text" class="form-control" name="perihal" value="{{ $tsm->perihal }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_surat">Tanggal Surat</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="tgl_surat" value="{{ $tsm->tgl_surat }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tgl_diterima">Tanggal Diterima</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="tgl_diterima" value="{{ $tsm->tgl_diterima }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Lampiran</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="exampleInputFile" value="{{ $tsm->file }}">
                                    <label class="custom-file-label" for="exampleInputFile">{{ $tsm->file }}</label>
                                </div>
                            </div>
                            <small style="color:red">
                                *Format lampiran yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF
                            <br/>*Ukuran maksimal file 2 MB
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan">{{ $tsm->keterangan }}</textarea>
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