<?php

namespace Database\Seeders;

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
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'password' => bcrypt('123456')
        ],[
            'name' => 'wahyu',
            'email' => 'wahyu@mail.com',
            'role' => 'dosen',
            'password' => bcrypt('123456')
        ],[
            'name' => 'budi',
            'email' => 'budi@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'ratna',
            'email' => 'ratna@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'feby',
            'email' => 'feby@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'citra',
            'email' => 'citra@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'intan',
            'email' => 'intan@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'syamsul',
            'email' => 'syamsul@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'lutfi',
            'email' => 'lutfi@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'habib',
            'email' => 'habib@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'fizi',
            'email' => 'fizi@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ],[
            'name' => 'dimas',
            'email' => 'dimas@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ]];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
