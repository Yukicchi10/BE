<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajarans';
    protected $fillable = [
        'id',
        'id_class',
        'id_dosen',
        'nama_mapel',
        'deskripsi_mapel',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    protected $primaryKey = 'id';

    public function materi()
    {
        return $this->hasMany(MataPelajaran::class, 'idMapel', 'idMapel');
    }
}
