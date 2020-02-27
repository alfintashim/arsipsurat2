@extends('layouts.app')

@section('title')
    | Laporan | Surat Keluar
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">

    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/>
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
            Laporan Surat Keluar
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
                <div class="card-body">
                    <div class="row input-daterange">
                        <form role="form" action="{{ route('lsk.download') }}" method="get">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-append">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </span>
                                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Dari tanggal" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-append">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </span>
                                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Ke tanggal" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" name="filter" id="filter" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                    <button type="button" name="refresh" id="refresh" class="btn btn-default"><i class="fas fa-sync"></i> Refresh</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="suratkeluars_table">
                                <thead>
                                <tr align="center">
                                    <th>Perihal</th>
                                    <th>Tujuan Surat</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Tanggal Catat</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
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
@endsection

@section('script')
<!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

{{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> --}}

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script>
$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'yyyy-mm-dd',
  autoclose:true
 });

 load_data();

 function load_data(from_date = '', to_date = '')
 {
  $('#suratkeluars_table').DataTable({
    "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json",
        "sEmptyTable": "Tidak ada data di database"
      },
   processing: true,
   serverSide: true,
   ajax: {
    url:'{{ route("lsk.index") }}',
    data:{from_date:from_date, to_date:to_date}
   },
   columns: [
    {
     data:'perihal',
     name:'perihal'
    },
    {
     data:'tujuan',
     name:'tujuan'
    },
    {
     data:'no_surat',
     name:'no_surat'
    },
    {
     data:'tgl_surat',
     name:'tgl_surat'
    },
    {
     data:'tgl_catat',
     name:'tgl_catat'
    }
   ]
  });
 }

 $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#suratkeluars_table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Isi data tanggal terlebih dahulu');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#suratkeluars_table').DataTable().destroy();
  load_data();
 });

});

</script>
@endsection