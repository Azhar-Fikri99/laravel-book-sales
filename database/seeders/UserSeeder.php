<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([                  // ini di import ke model
            "name"=> "Admin",
            "email"=> "admin@example.com",
            "password"=> bcrypt("admin123"),
            'role'=> 'admin'
        ]);

        User::create([
            "name"=> "Staff",
            "email"=> "staff@example.com",
            "password"=> bcrypt('staff123'),
            'role'=> 'staff'
        ]);

        
        User::create([
            "name"=> "Customer",
            "email"=> "customer@example.com",
            "password"=> bcrypt('customer123'),
            'role'=> 'customer'
        ]);
        
        
    }
}
