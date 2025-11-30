<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Aerni\Spotify\Facades\Spotify;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;

class SpotifySeeder extends Seeder
{
   public function run(): void
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
        ];

        foreach ($targetArtists as $artistName) {
            $searchResult = Spotify::searchArtists($artistName)->limit(1)->get();
            $artistData = $searchResult['artists']['items'][0] ?? null;

            if (!$artistData) {
                $this->command->error("  - Artist not found: $artistName");
                continue; 
            }

            $artist = Artist::firstOrCreate(
                ['artistName' => $artistData['name']]
            );
            
            $this->command->info("  - Found ID: " . $artist->id);

            $albumsResponse = Spotify::artistAlbums($artistData['id'])
                ->includeGroups('album')
                ->limit(40) 
                ->get();

            $albums = $albumsResponse['items'] ?? [];

            foreach ($albums as $spotifyAlbum) {
                
                $imageUrl = $spotifyAlbum['images'][0]['url'] ?? null;
                $unformattedData = $spotifyAlbum['release_date'];
                $preciseData = $spotifyAlbum['release_date_precision'];

                $extractGenres = $artistData['genres'] ?? [];
                $albumGenre = !empty($extractGenres) ? ucwords($extractGenres[0]) : 'Alternative';

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
                    
                    $tracksResponse = Spotify::albumTracks($spotifyAlbum['id'])->limit(50)->get();

                    foreach ($tracksResponse['items'] ?? [] as $track) {
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