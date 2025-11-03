<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Song;
use App\Models\Album;

class ArtistsTableSeeder extends Seeder
{
    // Seed the Artist table with one-to-many relationship for Album and Songs
    public function run(): void
    {

        Artist::factory()
            ->count(50)
            ->has(
                Album::factory()->count(3)
                    ->has(Song::factory()->count(10))
            )
            ->create();
    }
}




