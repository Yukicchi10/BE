<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $guarded = [];

    protected $primaryKey = 'idKelas';

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'idKelas', 'idKelas');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'idMateri', 'idMateri');
    }
}
