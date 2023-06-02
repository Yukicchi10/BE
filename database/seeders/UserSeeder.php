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
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'password' => bcrypt('123456')
        ], [
            'email' => 'wahyu@mail.com',
            'role' => 'dosen',
            'password' => bcrypt('123456')
        ], [
            'email' => 'budi@mail.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('123456')
        ]];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
