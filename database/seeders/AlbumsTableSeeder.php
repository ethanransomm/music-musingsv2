<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\Artist;

// Note: The seeder code was used to generate the albums table with initial data for 
// for the beginning stages of this coursework. It has now been commented out as the only seeder being used is
// SpotifySeeder.

/* class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   /*  public function run(): void
    {

         if (Album::count() > 0) { 
            return; 
        }

            $artist= Artist::where('artist_name', 'Interpol')->first();

            if ($artist) {
             Album::create([
            'title' => 'Turn on the Bright Lights',
            'artist_id' => $artist -> id,
            'release_date' => '2002-08-20',
            'genre' => 'Post-punk revival',
             ]);
            }
 */


/* 
            $artist= Artist::where('artist_name', 'The Strokes')->first();

            if ($artist) {
             Album::create([
             'title' => 'Is This It',
             'artist_id' => $artist -> id,
             'release_date' => '2001-07-30',
             'genre' => 'Garage rock revival',
             ]);       
            }


            $artist = Artist::where('artist_name', 'The White Stripes')->first();

            if ($artist) {    
             Album::create([
            'title' => 'Elephant',
            'artist_id' => $artist -> id,
            'release_date' => '2003-04-01',
            'genre' => 'Alternative rock',
            ]);
            }

            $artist = Artist::where('artist_name', 'Madvillain')->first();

            if ($artist) {
            Album::create([
            'title' => 'Madvillainy',
            'artist_id' => $artist -> id,
            'release_date' => '2004-03-23',
            'genre' => 'Hip hop',
            ]);
            }

            $artist = Artist::where('artist_name', 'Roy Orbison')->first();

            if ($artist) {
            Album::create([
            'title' => 'In Dreams',
            'artist_id' => $artist -> id,
            'release_date' => '1963-07-01',
            'genre' => 'Rock and roll',
            ]);
            }


        }
    }       */
