<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\materi;
use App\Models\tugas;
use App\Models\TugasMurid;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [[
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'password' => bcrypt('123456')
        ], [
            'email' => 'novi@mail.com',
            'role' => 'dosen',
            'password' => bcrypt('123456')
        ], [
            'email' => 'budi@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],];
        foreach ($userData as $key => $val) {
            User::create($val);
        }

        $dosen = [
            'id_user' => '2',
            'nama' => 'Novita Citra Rahayu, S.Kom, M.T',
            'nidn' => '0001075603432',
            'tempat' => 'Jakarta',
            'tgl_lahir' => '1995-02-01 10:59:52',
            'jns_kelamin' => 'perempuan',
            'agama' => 'Islam',
            'alamat' => 'Jl. Gajahmada No. 47 Ketintang, Surabaya Jawa Timur',
            'telepon' => '085987123564',
            'kd_pos' => '78254',
        ];
        Dosen::create($dosen);

        $kelas =[
            'nama_kelas' => 'Teknik Informatika',
            'angkatan' => '2018'
        ];
        Kelas::create($kelas);

        $mahasiswa = [
            'id_user' => '3',
            'id_class' => '1',
            'nama' => 'Budi Sudarmaji',
            'nim' => '2018749273',
            'tempat' => 'Bandung',
            'tgl_lahir' => '2000-12-11 10:59:52',
            'jns_kelamin' => 'laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Hayam wuruk No. 5 Gayungan, Surabaya Jawa Timur',
            'telepon' => '085987125564',
            'kd_pos' => '78235',
            'nama_ayah' => 'Susanto',
            'nama_ibu' => 'Indah'
        ];
        Mahasiswa::create($mahasiswa);

        $mataKuliah = [
            'id_class' => '1',
            'id_dosen'=> '1',
            'nama_mapel' => 'Pemrograman Web',
            'deskripsi_mapel' => 'Pada mata kuliah pemrograman web, Anda akan mempelajari berbagai konsep, teknologi, dan keterampilan yang terkait dengan pengembangan aplikasi web.',
            'room' => 'Lab Komputer A.2.1',
            "sks" => "3",
            "day"=> "Senin",
            "start_time" => "07.00",
            "end_time"=>"09.30"
        ];
        MataPelajaran::create($mataKuliah);

        $materi = [
            'createdBy'=>'1',
            'id_mapel'=>'1',
            'id_kelas' => '1',
            'judul'=> 'Dasar Dasar HTML',
            'deskripsi'=> 'HTML adalah bahasa markup yang digunakan untuk membangun struktur dasar halaman web. Anda akan mempelajari elemen-elemen HTML, seperti tag, atribut, tautan, gambar, tabel, formulir, dan lain-lain.',
            'file'=> 'http://localhost:8000/materi/dummy.pdf'
        ];
        materi::create($materi);

        $tugas = [
            'id_kelas'=>'1',
            'id_mapel' => '1',
            'id_dosen' => '1',
            'title' => 'Tugas HTML',
            'description' => 'Buatlah essay tentang sejarah website dan HTML'
        ];
        tugas::create($tugas);

        $tugasMurid = [
            'id_tugas' => '1',
            'id_mahasiswa' => '1',
            'file' => 'http://localhost:8000/tugas/dummy.pdf',
            'nilai' => '90',
        ];
        TugasMurid::create($tugasMurid);
    }
}
