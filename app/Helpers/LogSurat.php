<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use App\Log_surat;
use App\SuratMasuk;
use App\Roles;

Class LogSurat extends Model
{
    public static function createLog($id_sm, $id_create, $status, $read, $disp_ke, $tgl_disp, $disp_note=NULL)
    {
        if ($disp_note!=NULL) {
            Log_surat::create([
                'id_sm'       => $id_sm,
                'id_create'   => $id_create,
                'status'      => $status,
                'read'        => $read,
                'disp_ke'     => $disp_ke,
                'tgl_disp'    => $tgl_disp,
                'disp_note'   => $disp_note
            ]);

        }
        else{
            Log_surat::create([
                'id_sm'       => $id_sm,
                'id_create'   => $id_create,
                'status'      => $status,
                'read'        => $read,
                'disp_ke'     => $disp_ke,
                'tgl_disp'    => $tgl_disp
            ]);

        }
    }

    public static function log()
    {
        $logs = Log_surat::join('users','log_surats.id_create','users.id')
        ->join('suratmasuks', 'log_surats.id_sm', '=', 'suratmasuks.id')
        ->select('log_surats.*', 'suratmasuks.no_surat', 'users.nama')
        ->orderBy('log_surats.id', 'desc')->limit(5)->get();

        return $logs;
    }
}
?>