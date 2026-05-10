<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fname' => 'Admin',
            'lname' => 'System',
            'phone' => '01000000000',
            'email' => 'admin@system.com',
            'address'=> 'cairo',
            'profile_image' => '../../storage/app/public/profile_picture.jfif',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);
    }
}