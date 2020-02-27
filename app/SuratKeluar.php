<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'suratkeluars';

    protected $fillable = [
        'no_surat',
        'tujuan',
        'perihal',
        'tgl_surat',
        'tgl_catat',
        'file',
        'keterangan',
        'status',
        'notif'
    ];
}
