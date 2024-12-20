<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Toko',
            'email' => 'toko@batik.com',
            'password' => bcrypt('batik123'), // Pastikan password dienkripsi
            'role' => 'admin', // Sesuaikan jika ada kolom 'role'
        ]);

        User::create([
            'name' => 'Pengguna Toko',
            'email' => 'user@batik.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);

    }
}
