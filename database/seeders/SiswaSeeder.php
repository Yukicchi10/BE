<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswa = [
            'nama' => 'ujang',
            'nim' => '123123123',
            'email' => 'ujang@gmail.com',
            'password' => bcrypt('ujang123'),
            'tempat' => 'Bandung',
            'tgl_lahir' => now(),
            'jns_kelamin' => 'laki-laki',
            'agama' => 'islam',
            'nama_ayah' => 'Asep Stroberi',
            'nama_ibu' => 'Nila Kharisma',
            'alamat' => 'Jl Bojong Soang no 103, Bojong, Kota Bandung',
            'telepon' => '081212121212',
            'kd_pos' => '11111',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('siswas')->insert($siswa);
        Siswa::factory()->count(10)->create();
    }
}
