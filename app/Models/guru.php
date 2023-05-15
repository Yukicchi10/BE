<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Guru extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'idGuru',
        'nama',
        'nisn',
        'email',
        'password',
        'tempat',
        'tgl_lahir',
        'jns_kelamin',
        'agama',
        'alamat',
        'telepon',
        'kd_pos',
        'created_at',
        'updated_at',
    ];


    protected $primaryKey = 'idGuru';

    public function materi()
    {
        return $this->hasMany(Materi::class, 'idGuru', 'createdBy');
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
