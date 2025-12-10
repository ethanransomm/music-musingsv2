<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\SpotifyService; // <--- Using YOUR Service
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;

class SpotifySeeder extends Seeder
{
    public function run(SpotifyService $spotify): void
    {
        $targetArtists = [
            'Radiohead', 
            'Interpol', 
            'MF DOOM', 
            'Car Seat Headrest', 
            'George Harrison',
            'Outkast',
            'Genesis',
            'The Cure',
            'The Smashing Pumpkins',
            'The Velvet Underground',
            'Bright Eyes',
            'The Clash',
            'The Strokes',
            'The Libertines',
            'Pulp',
            'my bloody valentine',
            'Geese',
            'Leonard Cohen',
            'Bob Dylan',
        ];

        foreach ($targetArtists as $artist_name) {
            $this->command->info("Finding: $artist_name's Albums");

           
            $artistData = $spotify->searchArtist($artist_name);

            if (!$artistData) {
                $this->command->error("  - Artist not found: $artist_name");
                continue; 
            }

            $unprocessedGenres = $artistData['genres'] ?? [];
            $albumGenre = !empty($unprocessedGenres) ? ucwords($unprocessedGenres[0]) : 'Alternative';

            $artist = Artist::updateOrCreate(
                ['artist_name' => $artistData['name']],
                ['image_url' => $artistData['image_url']] 
            );
            
            $this->command->info("  - Found ID: " . $artist->id);

            $albums = $spotify->getArtistAlbums($artistData['id']);

             if (empty($albums)) {
                $this->command->warn("    ! No albums found or API error. Skipping...");
                continue;
            }

            foreach ($albums as $spotifyAlbum) {
                
                $imageUrl = $spotifyAlbum['images'][0]['url'] ?? null;
                $unformattedData = $spotifyAlbum['release_date'];
                $preciseData = $spotifyAlbum['release_date_precision'];

                $formattedData = $unformattedData;
                if ($preciseData === 'year') {
                    $formattedData .= '-01-01';
                } elseif ($preciseData === 'month') {
                    $formattedData .= '-01';    
                }

                $album = Album::updateOrCreate(
                    ['title' => $spotifyAlbum['name']], 
                    [
                        'artist_id' => $artist->id,
                        'genre' => $albumGenre, 
                        'cover_url' => $imageUrl,
                        'release_date' => $formattedData,
                        'release_date_precision' => $preciseData
                    ]
                );

                $this->command->info("    - Album: " . $album->title);

                if (Song::where('album_id', $album->id)->count() === 0) {
                    
                    $tracks = $spotify->getAlbumTracks($spotifyAlbum['id']);

                    foreach ($tracks as $track) {
                        Song::create([
                            'album_id' => $album->id, 
                            'title' => $track['name'],
                            'duration' => intval($track['duration_ms'] / 1000),
                            'track_number' => $track['track_number'] ?? 0
                        ]);
                    }
                }
            }
        }
    }
}