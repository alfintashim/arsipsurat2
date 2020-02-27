<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'suratmasuks';

    protected $fillable = [
        'no_surat',
        'asal',
        'perihal',
        'tgl_surat',
        'tgl_diterima',
        'file',
        'keterangan',
        'status',
        'notif',
        'read'
    ];
}
