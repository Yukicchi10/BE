<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Kelas extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'kelas';
    protected $guarded = [];

    protected $primaryKey = 'id';

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id', 'id');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'idMateri', 'idMateri');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
