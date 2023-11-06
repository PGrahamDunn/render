<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VersionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('version_types')->insert([
            'name' => 'New'
        ]);
        DB::table('version_types')->insert([
            'name' => 'Updated'
        ]);
        DB::table('version_types')->insert([
            'name' => 'Fixed'
        ]);
    }
}
