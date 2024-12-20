<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

}
User::create([
    'name' => 'Admin Toko',
    'email' => 'toko@batik.com',
    'password' => bcrypt('batik123'), // pastikan password dienkripsi
    'role' => 'admin', // tambahkan jika ada field role
]);
