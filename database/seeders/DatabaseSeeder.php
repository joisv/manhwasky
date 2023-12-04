<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chapter;
use App\Models\ChapterContent;
use App\Models\Gallery;
use App\Models\Genre;
use App\Models\Series;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Gallery::factory(5)->create();
        Series::factory(10)->create();
        Genre::factory(10)->create();
        Chapter::factory(10)->create();
        ChapterContent::factory(20);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
