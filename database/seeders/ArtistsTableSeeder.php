<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Song;
use App\Models\Album;

// Note: The seeder code was used to generate the artists table with initial data for 
// for the beginning stages of this coursework. It has now been commented out as the only seeder being used is
// SpotifySeeder.


/* class ArtistsTableSeeder extends Seeder
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
} */




