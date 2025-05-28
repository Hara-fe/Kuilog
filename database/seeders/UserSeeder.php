<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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
        //
         DB::table('users')->insert([[
            'name' => 'aoki',
            'email' => 'test@test.com',
            'role' => 0,
            'password' => Hash::make('password123'),
        ],[ 
            'name' => 'yamada',
            'email' => 'admin@admin.com',
            'role' => 5,
            'password' => Hash::make('password123'),
        ],[
            'name' => 'tanaka',
            'email' => 'pass@pass.com',
            'role' => 5,
            'password' => Hash::make('password123'),
        ]
        ]);
    }
}
