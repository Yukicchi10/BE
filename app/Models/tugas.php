<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $guarded = [];

    protected $primaryKey = 'idTugas';

    public function materi()
    {
        return $this->hasOne(Materi::class, 'idMateri', 'idMateri');
    }

    public function tugasMurid()
    {
        return $this->hasMany(TugasMurid::class, 'idTugas', 'idTugas');
    }
}
