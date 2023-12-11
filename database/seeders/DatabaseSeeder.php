<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chapter;
use App\Models\ChapterContent;
use App\Models\Gallery;
use App\Models\Genre;
use App\Models\Series;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['admin', 'demo'];
        
        $this->call([
            PermissionSeeder::class,
            RolesSeeder::class
        ]);
        
        foreach ($roles as $role) {
            # code...
            User::factory()->create([
                'name' => $role,
                'email' => $role.'@example.com',
            ])->assignRole($role);
        }
        
        Gallery::factory(5)->create();
        Series::factory(10)->create();
        Genre::factory(10)->create();
        Chapter::factory(10)->create();
        ChapterContent::factory(20);
        
    }
}
