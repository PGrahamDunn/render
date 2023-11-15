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
            'name' => 'Admin',
            'description' => 'This is the Admin role.'
        ]);

        DB::table('Roles')->insert([
            'name' => 'User',
            'description' => 'This is the User role.'
        ]);

        DB::table('Roles')->insert([
            'name' => 'Role_3',
            'description' => 'This is the Role_3 role.'
        ]);
    }
}
