<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\password;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Jeremy Kratzer',
            'badge_id' => '1735',
            'email' => 'Jeremy.Kratzer@pgrahamdunn.com',
            'password' => bcrypt('jeremy_1'),
        ]);

        DB::table('users')->insert([
            'name' => 'Jerry Kuphal III',
            'badge_id' => '13',
            'email' => 'John.Smith@pgrahamdunn.com',
            'password' => bcrypt('jerry_1'),
        ]);

    }
}
