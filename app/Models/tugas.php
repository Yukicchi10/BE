<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $guarded = [];

    protected $primaryKey = 'id';

    public function tugasMurid()
    {
        return $this->hasMany(TugasMurid::class, 'id_tugas');
    }
}
