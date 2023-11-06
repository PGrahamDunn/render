<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Version;
use App\Models\Version_Type;
use App\Models\VersionNote;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::truncate();
        Role::truncate();
        DB::table('role_User')->truncate();
        Version::truncate();
        DB::table('version_types')->truncate();
        DB::table('version_notes')->truncate();

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            Role_UserSeeder::class,
            VersionSeeder::class,
            VersionTypeSeeder::class,
            VersionNoteSeeder::class
        ]);   
    }
}
