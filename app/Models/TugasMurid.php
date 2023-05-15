<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasMurid extends Model
{
    use HasFactory;
    protected $table = 'tugas_murids';
    protected $guarded = [];

    protected $primaryKey = 'idTugasMurid';

    public function siswa()
    {
        return $this->belongSTo(Siswa::class, 'idSiswa', 'idSiswa');
    }

    public function tugas()
    {
        return $this->belongSTo(Tugas::class, 'idTugas', 'idTugas');
    }
}
