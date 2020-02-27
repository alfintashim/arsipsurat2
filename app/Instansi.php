<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansis';

    protected $fillable = [
        'nama',
        'status',
        'alamat',
        'ketua',
        'nip',
        'website',
        'email',
        'logo',
        'id_create'
    ];
}
