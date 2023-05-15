<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guru = [
            'nama' => 'ujang',
            'nip' => '123123123',
            'email' => 'oldujang@gmail.com',
            'password' => bcrypt('ujang123'),
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

        DB::table('gurus')->insert($guru);
        Guru::factory()->count(10)->create();
    }
}
