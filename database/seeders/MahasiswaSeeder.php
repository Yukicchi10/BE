<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = [
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

        DB::table('mahasiswas')->insert($mahasiswa);
        Mahasiswa::factory()->count(10)->create();
    }
}
