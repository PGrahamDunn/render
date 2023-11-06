<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VersionNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('version_notes')->insert([
            'version_id' => 1,
            'version_type_id' => 1,
            'description' => fake()->sentence()
        ]);
        DB::table('version_notes')->insert([
            'version_id' => 1,
            'version_type_id' => 2,
            'description' => fake()->sentence()
        ]);
        DB::table('version_notes')->insert([
            'version_id' => 1,
            'version_type_id' => 3,
            'description' => fake()->sentence()
        ]);
    }
}
