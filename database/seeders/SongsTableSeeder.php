<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Song;
use Illuminate\Support\Facades\DB;
use App\Models\Album;
use App\Models\Artist;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

         if (Song::count() > 0) { 
            return; 
        }

            $album = Album::where('title', 'Turn on the Bright Lights')->first();
            if ($album) {
                Song::create([
                'title' => 'Obstacle 1',
                'duration' => '249',
                'album_id' => $album->id,
                'artist_id' => $album->artist_id,
            ]);
        }

            $album = Album::where('title', 'Is This It')->first();
            if ($album) {
                Song::create([
                'title' => 'Last Nite',
                'duration' => '202',
                'album_id' => $album->id,
                'artist_id' => $album->artist_id,
             ]);
        }

            $album = Album::where('title', 'Elephant')->first();
            if ($album) {
                Song::create([
                'title' => 'Seven Nation Army',
                'duration' => '232',
                'album_id' => $album->id,
                'artist_id' => $album->artist_id,
            
            ]);
        }

            $album = Album::where('title', 'In Dreams')->first();
            if ($album) {
                Song::create([
                    'title' => 'In Dreams',
                    'duration' => '178',
                    'album_id' => $album->id,
                    'artist_id' => $album->artist_id,
                ]);
            }

            $album = Album::where('title', 'Madvillainy')->first();
            if ($album) {
                Song::create([
                    'title' => 'Fancy Clown',
                    'duration' => '116',
                    'album_id' => $album->id,
                    'artist_id' => $album->artist_id,
                ]);

        }
      
    }
}
