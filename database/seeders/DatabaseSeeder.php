<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama_user' => 'Administrator PAUD',
            'username'  => 'admin',
            'password'  => Hash::make('admin123'),
            'role'      => 'admin',
        ]);

        User::create([
            'nama_user' => 'Kepala PAUD',
            'username'  => 'kepala',
            'password'  => Hash::make('kepala123'),
            'role'      => 'ortu',
        ]);
    }
}