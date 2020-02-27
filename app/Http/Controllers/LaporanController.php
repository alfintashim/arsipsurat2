<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratMasuk;
use DB;
use PDF;
use Carbon\Carbon;
use App\Instansi;

class LaporanController extends Controller
{
    public function index_lsm(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->from_date))
            {
                $data = DB::table('suratmasuks')
                ->whereBetween('tgl_diterima', array($request->from_date, $request->to_date))
                ->orderBy('id_kns', 'desc')
                ->get();
            }
            else
            {
            $data = DB::table('suratmasuks')
                ->orderBy('id_kns', 'desc')
                ->get();
            }
        return datatables()->of($data)->make(true);
        }

        return view('surat_masuk.laporan');
    }

    public function download_lsm(Request $request)
    {
        $profil = Instansi::first();
        $today = Carbon::now()->toDateTimeString();
        $fileName = ('Laporan Surat Masuk '. $today .'.pdf');

        if (!empty($request->from_date) && !empty($request->to_date)) {

            $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
            $to_date = Carbon::parse($request->to_date)->format('Y-m-d');

            $data = DB::table('suratmasuks')
                ->whereBetween('tgl_diterima', array($request->from_date, $request->to_date))
                ->orderBy('id_kns', 'desc')
                ->get();

                $pdf = PDF::loadView('surat_masuk.pdf', [
                    'data' => $data,
                    'fileName' => $fileName,
                    'profil' => $profil
                    ])
                    ->setPaper('a4','portrait');

                return $pdf->stream($fileName);
        } else {
            $data = DB::table('suratmasuks')
                ->orderBy('id_kns', 'desc')
                ->get();

                $pdf = PDF::loadView('surat_masuk.pdf', [
                    'data' => $data,
                    'fileName' => $fileName,
                    'profil' => $profil
                    ])
                    ->setPaper('a4','portrait');

                return $pdf->stream($fileName);
        }

    }

    public function index_lsk(Request $request)
    {
        if(request()->ajax())
        {
            if(!empty($request->from_date))
            {
                $data = DB::table('suratkeluars')
                ->whereBetween('tgl_catat', array($request->from_date, $request->to_date))
                ->orderBy('id_kns', 'desc')
                ->get();
        }
            else
        {
        $data = DB::table('suratkeluars')
            ->orderBy('id_kns', 'desc')
            ->get();
        }
        return datatables()->of($data)->make(true);
        }

        return view('surat_keluar.laporan');
    }

    public function download_lsk(Request $request)
    {
        $profil = Instansi::first();
        $today = Carbon::now()->toDateTimeString();
        $fileName = ('Laporan Surat Keluar '. $today .'.pdf');

        if (!empty($request->from_date) && !empty($request->to_date)) {

            $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
            $to_date = Carbon::parse($request->to_date)->format('Y-m-d');

            $data = DB::table('suratkeluars')
                ->whereBetween('tgl_catat', array($request->from_date, $request->to_date))
                ->orderBy('id_kns', 'desc')
                ->get();

                $pdf = PDF::loadView('surat_keluar.pdf', [
                    'data' => $data,
                    'fileName' => $fileName,
                    'profil' => $profil
                    ])
                    ->setPaper('a4','portrait');

                return $pdf->stream($fileName);
        } else {
            $data = DB::table('suratkeluars')
                ->orderBy('id_kns', 'desc')
                ->get();

                $pdf = PDF::loadView('surat_keluar.pdf', [
                    'data' => $data,
                    'fileName' => $fileName,
                    'profil' => $profil
                    ])
                    ->setPaper('a4','portrait');

                return $pdf->stream($fileName);
        }

    }
}
