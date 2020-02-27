<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id',
        'nama_role',
        'ket'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
