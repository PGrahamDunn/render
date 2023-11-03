<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Roles')->insert([
            'name' => 'Admin'
        ]);

        DB::table('Roles')->insert([
            'name' => 'User'
        ]);

        DB::table('Roles')->insert([
            'name' => 'Role_3'
        ]);
    }
}
