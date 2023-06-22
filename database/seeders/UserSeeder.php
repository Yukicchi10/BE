<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Calendar;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Likes;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\materi;
use App\Models\Replies;
use App\Models\StudentAttendance;
use App\Models\Thread;
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
            'email' => 'yopinugraha@mail.com',
            'role' => 'dosen',
            'password' => bcrypt('123456')
        ], [
            'email' => 'dinarrahayu@mail.com',
            'role' => 'dosen',
            'password' => bcrypt('123456')
        ], [
            'email' => 'rikaamelia19@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ], [
            'email' => 'farizsalman19@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],];
        foreach ($userData as $key => $val) {
            User::create($val);
        }

        $dosen = [
            'id_user' => '2',
            'nama' => 'Yopi Nugraha, M.Kom',
            'nidn' => '0001075603432',
            'tempat' => 'Garut',
            'tgl_lahir' => '1995-02-01 10:59:52',
            'jns_kelamin' => 'laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Gajahmada No. 47 Ketintang, Surabaya Jawa Timur',
            'telepon' => '085987123564',
            'kd_pos' => '78254',
        ];
        Dosen::create($dosen);

        $dosen = [
            'id_user' => '3',
            'nama' => 'Dinar Rahayu, M.Kom',
            'nidn' => '0001075603432',
            'tempat' => 'Garut',
            'tgl_lahir' => '1995-02-01 10:59:52',
            'jns_kelamin' => 'perempuan',
            'agama' => 'Islam',
            'alamat' => 'Jl. Gajahmada No. 47 Ketintang, Surabaya Jawa Timur',
            'telepon' => '085987123564',
            'kd_pos' => '78254',
        ];
        Dosen::create($dosen);

        $kelas = [
            'nama_kelas' => 'Sistem Informasi B',
            'angkatan' => '2019'
        ];
        Kelas::create($kelas);

        $mahasiswa = [
            'id_user' => '4',
            'id_class' => '1',
            'nama' => 'Rika Amelia',
            'nim' => '2018749273',
            'tempat' => 'Garut',
            'tgl_lahir' => '2001-05-14 10:59:52',
            'jns_kelamin' => 'perempuan',
            'agama' => 'Islam',
            'alamat' => 'Kp.Papandak Desa Sukamenak',
            'telepon' => '085987125564',
            'kd_pos' => '78235',
            'nama_ayah' => 'Jajang',
            'nama_ibu' => 'Oneng'
        ];
        Mahasiswa::create($mahasiswa);

        $mahasiswa = [
            'id_user' => '5',
            'id_class' => '1',
            'nama' => 'Fariz Salman W',
            'nim' => '2018749273',
            'tempat' => 'Garut',
            'tgl_lahir' => '2001-05-14 10:59:52',
            'jns_kelamin' => 'laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Pataruman',
            'telepon' => '085987125564',
            'kd_pos' => '78235',
            'nama_ayah' => 'Dudi',
            'nama_ibu' => 'Ani'
        ];
        Mahasiswa::create($mahasiswa);


        $mataKuliah = [
            'id_class' => '1',
            'id_dosen' => '1',
            'nama_mapel' => 'Pemrograman Web',
            'deskripsi_mapel' => 'Pada mata kuliah pemrograman web, Anda akan mempelajari berbagai konsep, teknologi, dan keterampilan yang terkait dengan pengembangan aplikasi web.',
            'room' => 'Lab Komputer A.2.1',
            "sks" => "3",
            "day" => "Senin",
            "start_time" => "07.00",
            "end_time" => "09.30"
        ];
        MataPelajaran::create($mataKuliah);

        $materi = [
            'createdBy' => '1',
            'id_mapel' => '1',
            'id_kelas' => '1',
            'judul' => 'Dasar Dasar HTML',
            'deskripsi' => 'HTML adalah bahasa markup yang digunakan untuk membangun struktur dasar halaman web. Anda akan mempelajari elemen-elemen HTML, seperti tag, atribut, tautan, gambar, tabel, formulir, dan lain-lain.',
            'file' => 'http://localhost:8000/materi/dummy.pdf'
        ];
        materi::create($materi);

        $tugas = [[
            'id_kelas' => '1',
            'id_mapel' => '1',
            'id_dosen' => '1',
            'title' => 'Tugas HTML',
            'description' => 'Buatlah essay tentang sejarah website dan HTML',
            'deadline' => '2023-07-01 10:59:52',
            'deadline_time' => '2023-06-13T19:15:00.328Z',
        ], [
            'id_kelas' => '1',
            'id_mapel' => '1',
            'id_dosen' => '1',
            'title' => 'Tugas Pratikum ',
            'description' => 'Buatlah website sederhana, kirim laporannya dalam bentuk Pdf',
            'deadline' => '2023-07-01 10:59:52',
            'deadline_time' => '2023-06-13T19:15:00.328Z',
        ], [
            'id_kelas' => '1',
            'id_mapel' => '1',
            'id_dosen' => '1',
            'title' => 'Tugas Framework',
            'description' => 'Sebutkan dan Jelaskan Jenis Jenis Framework dalam pengembangan website!',
            'deadline' => '2023-07-11 10:59:52',
            'deadline_time' => '2023-06-13T19:15:00.328Z',
        ]];

        foreach ($tugas as $key => $val) {
            tugas::create($val);
        }

        $tugasMurid = [[
            'id_tugas' => '1',
            'id_mahasiswa' => '1',
            'file' => 'http://localhost:8000/tugas/dummy.pdf',
            'filename' => 'dummy.pdf',
            'nilai' => '90',
        ], [
            'id_tugas' => '2',
            'id_mahasiswa' => '1',
            'file' => 'http://localhost:8000/tugas/dummy.pdf',
            'filename' => 'dummy.pdf',
            'nilai' => '0',
        ]];
        foreach ($tugasMurid as $key => $val) {
            TugasMurid::create($val);
        }

        $attendance = [
            'id_mapel' => '1',
            'pertemuan' => '1'
        ];
        Attendance::create($attendance);

        $studentAttendance = [
            'id_pertemuan' => '1',
            'id_mahasiswa' => '1',
            'status' => 'Hadir',
        ];
        StudentAttendance::create($studentAttendance);

        $studentAttendance = [
            'id_pertemuan' => '1',
            'id_mahasiswa' => '2',
            'status' => 'Hadir',
        ];
        StudentAttendance::create($studentAttendance);

        $calendar = [
            'title' => 'Ujian Akhir Semester',
            'start' => '2023-06-19 07:01:04',
            'end' => '2023-06-23 07:01:04'
        ];
        Calendar::create($calendar);

        $thread = [
            'id_mapel' => '1',
            'id_user'=> '4',
            'content' => 'Halo guys, apakah sudah ada yg ngerjain tugas. sulit nggak sih. '
        ];
        Thread::create($thread);

        $likes = [
            'id_thread' => '1',
            'id_user' => '2',
        ];
        Likes::create($likes);

        $reply =[
            'id_thread' => '1',
            'id_user' => '2',
            'content' => 'Mudah Rika, jangan kebanyakan ngeluh yaa.'
        ];
        Replies::create($reply);

        $reply =[
            'id_thread' => '1',
            'id_user' => '5',
            'content' => 'Sangat mudah Rika, Semangat!'
        ];
        Replies::create($reply);
    }
}
