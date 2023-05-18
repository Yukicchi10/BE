<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen = [
            'nama' => 'bujang',
            'nidn' => '11111111111',
            'email' => 'oldujang@gmail.com',
            'password' => bcrypt('bujang123'),
            'tempat' => 'Bandung',
            'tgl_lahir' => now(),
            'jns_kelamin' => 'laki-laki',
            'agama' => 'islam',
            'alamat' => 'Jl Bojong Soang no 103, Bojong, Kota Bandung',
            'telepon' => '081212121212',
            'kd_pos' => '11111',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('dosens')->insert($dosen);
        Dosen::factory()->count(10)->create();
    }
}
