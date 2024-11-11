<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Winda',
            'email' => 'adminwinda@mail.com',
            'password' => Hash::make('adminwinda'),
            'no_telp' => '1234567891',
            'role' => 'admin', 
        ]);
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Felda',
            'email' => 'adminfelda@mail.com',
            'password' => Hash::make('adminfelda'),
            'no_telp' => '7242471234',
            'role' => 'admin', 
        ]);
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Isti',
            'email' => 'administi@mail.com',
            'password' => Hash::make('administi'),
            'no_telp' => '1234567890',
            'role' => 'admin', 
        ]);
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Syafira',
            'email' => 'adminsyafira@mail.com',
            'password' => Hash::make('adminsyafira'),
            'no_telp' => '1234567890',
            'role' => 'admin', 
        ]);
        
    }
}
