<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeNomorSurat extends Model
{
    protected $table = 'kode_nomor_surats';

    protected $fillable = [
        'id',
        'kode',
        'nama_kode',
        'kategori'
    ];

    public function suratmasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }
}
