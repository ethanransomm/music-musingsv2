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
                'title' => 'Untitled',
                'duration' => '236',
                'album_id' => $album->id,
                'artist_id' => $album->artist_id,

            ]);

            Song::create([
                'title' => 'Obstacle 1',
                'duration' => '249',
                'album_id' => $album->id,
                'artist_id' => $album->artist_id,
            ]);

            Song::create([
                'title' => 'NYC',
                'duration' => '259',
                'album_id' => $album->id,
                'artist_id' => $album->artist_id,

            ]);

            Song::create([
                    'title' => 'PDA',
                    'duration' => '299',
                    'album_id' => $album->id,
                    'artist_id' => $album->artist_id,

                ]);

            Song::create([
                    'title' => 'Say Hello to the Angels',
                    'duration' => '268',
                    'album_id' => $album->id,
                    'artist_id' => $album->artist_id,

                ]);    

            Song::create([
                    'title' => 'Hands Away',
                    'duration' => '221',
                    'album_id' => $album->id,
                    'artist_id' => $album->artist_id,

                ]);    

            Song::create([
                'title' => 'Obstacle 2',
                'duration' => '234',
                'album_id' => $album->id,
                'artist_id' => $album->artist_id,

            ]);

            Song::create([
                    'title' => 'Stella was a diver and she was always down',
                    'duration' => '388',
                    'album_id' => $album->id,
                    'artist_id' => $album->artist_id,

                ]);

            Song::create([
                    'title' => 'Roland',
                    'duration' => '215',
                    'album_id' => $album->id,
                    'artist_id' => $album->artist_id,

                ]);    

            Song::create([
                    'title' => 'The New',
                    'duration' => '367',
                    'album_id' => $album->id,
                    'artist_id' => $album->artist_id,
                ]);    

            Song::create([
                    'title' => 'Leif Erikson',
                    'duration' => '240',
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
