<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\Artist;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         if (Album::count() > 0) { 
            return; 
        }

            $artist= Artist::where('artistName', 'Interpol')->first();

            if ($artist) {
             Album::create([
            'title' => 'Turn on the Bright Lights',
            'artist_id' => $artist -> id,
            'release_date' => '2002-08-20',
            'genre' => 'Post-punk revival',
             ]);
            }




            $artist= Artist::where('artistName', 'The Strokes')->first();

            if ($artist) {
             Album::create([
             'title' => 'Is This It',
             'artist_id' => $artist -> id,
             'release_date' => '2001-07-30',
             'genre' => 'Garage rock revival',
             ]);       
            }


            $artist = Artist::where('artistName', 'The White Stripes')->first();

            if ($artist) {    
             Album::create([
            'title' => 'Elephant',
            'artist_id' => $artist -> id,
            'release_date' => '2003-04-01',
            'genre' => 'Alternative rock',
            ]);
            }

            $artist = Artist::where('artistName', 'Madvillain')->first();

            if ($artist) {
            Album::create([
            'title' => 'Madvillainy',
            'artist_id' => $artist -> id,
            'release_date' => '2004-03-23',
            'genre' => 'Hip hop',
            ]);
            }

            $artist = Artist::where('artistName', 'Roy Orbison')->first();

            if ($artist) {
            Album::create([
            'title' => 'In Dreams',
            'artist_id' => $artist -> id,
            'release_date' => '1963-07-01',
            'genre' => 'Rock and roll',
            ]);
            }


        }
    }      
