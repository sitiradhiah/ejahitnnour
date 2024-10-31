<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Megat Haziq',
            'email' => 'megathaziq@gmail.com',
            'password' => Hash::make('password123'), // Hash the password
        ]);

        User::create([
            'name' => 'Siti Radhiah Megat',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('password456'),
        ]);
    }
}
