<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'), 
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Karyawan',
            'email' => 'cakar@example.com',
            'password' => Hash::make('123456789'), 
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     // 'akses' => 'Admin',
        //     'password' => Hash::make('password'), 
        // ]);
    }
}
