<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CreateUser extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'FioTec admin',
            'login' => 'adminFiotec',
            'password' => bcrypt('passFiotec'), 
       ]);
    }
}
