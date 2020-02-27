<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $fileName }}</title>

    <style>
        body{
            padding: 0;
            margin: 0;
        }
        .page{
            max-width: 80em;
            margin: 0 auto;
        }
        table th{
            text-align: center;
        }
        table td,
        table.layout{
            width: 100%;
            border-collapse: collapse;
        }
        table.display{
            margin: 1em 0;
        }
        table.display th,
        table.display td{
            border: 1px solid #B3BFAA;
            padding: .1em 1em;
        }
​
        table.display th{ background: #D5E0CC; }
        table.display td{ background: #fff; }
​
        table.responsive-table{
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        }
​
        .listcust {
            margin: 0;
            padding: 0;
            list-style: none;
            display:table;
            border-spacing: 10px;
            border-collapse: separate;
            list-style-type: none;
        }
​
        .customer {
            padding-left: 600px;
        }
    </style>
</head>
<body>
    <table align="center">
        <tr>
            <td>
                {{-- <img src="{{ asset('img/logo/'.$profil->logo) }}" alt=""> --}}
            </td>
            <td>
                <center>
                    <font size="4">PEMERINTAH KABUPATEN SAMBAS</font><br>
                    <font size="5"><b>{{ $profil->nama }}</b></font><br>
                    <font size="2"><i>{{ $profil->alamat }}</i></font>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
    </table>

    <br>

    <div class="page">
        <table class="layout display responsive-table" align="center">
            <thead>
                <tr>
                    {{-- <th>No.</th> --}}
                    <th>Perihal</th>
                    <th>Asal Surat</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Diterima</th>
                </tr>
            </thead>
            <tbody>
                {{-- @php $no=1 @endphp --}}
                @foreach ($data as $item)
                    <tr>
                        {{-- <td align="center" width="10">{{ $no++ }}</td> --}}
                        <td>{{ $item->perihal }}</td>
                        <td>{{ $item->asal }}</td>
                        <td>{{ $item->no_surat }}</td>
                        <td align="center">{{ date('j M Y', strtotime($item->tgl_surat)) }}</td>
                        <td align="center">{{ date('j M Y', strtotime($item->tgl_diterima)) }}</td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>