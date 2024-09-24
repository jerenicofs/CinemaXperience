<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([[
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'dob' => Carbon::now()->subYear(20),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => 'Member',
            'email' => 'member@gmail.com',
            'password' => bcrypt('member123'),
            'dob' => Carbon::now()->subYear(20),
            'role' => 'member',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => 'Non-Member',
            'email' => 'nonmember@gmail.com',
            'password' => bcrypt('nonmember123'),
            'dob' => Carbon::now()->subYear(20),
            'role' => 'non-member',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => 'Nico Jere',
            'email' => 'nico@gmail.com',
            'password' => bcrypt('nico123'),
            'dob' => Carbon::now()->subYear(20),
            'role' => 'member',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => 'Dellon Dlenz',
            'email' => 'dellon@gmail.com',
            'password' => bcrypt('dellon123'),
            'dob' => Carbon::now()->subYear(20),
            'role' => 'non-member',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => 'Selika Princess',
            'email' => 'selika@gmail.com',
            'password' => bcrypt('selika123'),
            'dob' => Carbon::now()->subYear(20),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => 'Bas Harrie',
            'email' => 'bas@gmail.com',
            'password' => bcrypt('bas123'),
            'dob' => Carbon::now()->subYear(20),
            'role' => 'non-member',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'name' => 'Dian To',
            'email' => 'dian@gmail.com',
            'password' => bcrypt('dian123'),
            'dob' => Carbon::now()->subYear(20),
            'role' => 'member',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]
    ]);
    }
}
