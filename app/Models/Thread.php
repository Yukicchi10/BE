<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Thread extends  Authenticatable implements JWTSubject
{
    use HasFactory;
    public function likes()
    {
        return $this->hasMany(Likes::class, 'id_thread');
    }
    public function replies()
    {
        return $this->hasMany(Replies::class, 'id_thread');
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
