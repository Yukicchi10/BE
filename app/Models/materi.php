<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materis';
    protected $guarded = [];

    protected $primaryKey = 'id';


    public function guru()
    {
        return $this->belongsTo(Guru::class, 'createdBy', 'idGuru');
    }

    public function matapelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'idMapel', 'idMapel');
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idKelas', 'idKelas');
    }

    public function tugas()
    {
        return $this->hasOne(Tugas::class, 'idTugas', 'idTugas');
    }
}
