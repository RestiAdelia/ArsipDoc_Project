<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'Resti@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'superadmin',
            'phone' => '081234567890',
            'alamat' => 'Jl. Contoh Alamat No. 123, Kota Contoh',
            'foto' => null,
        ]);
    }
}
