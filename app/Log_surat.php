<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log_surat extends Model
{
    protected $table = 'log_surats';

    protected $fillable = [
        'id_sm',
        'id_create',
        'status',
        'read',
        'disp_ke',
        'disp_note',
        'tgl_disp'
    ];
}
