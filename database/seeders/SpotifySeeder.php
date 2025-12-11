<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\SpotifyService; // <--- Using YOUR Service
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;

class SpotifySeeder extends Seeder
{
    /**
     * Seeds database with artists, albums, and songs retreived from Spotify API.
     * @param SpotifyService $spotify The Spotify service container.
     */
    public function run(SpotifyService $spotify): void
    {
        // List of target artists to be shown on the website.
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

        // Iterate through each target artist to find the relevant data.
        foreach ($targetArtists as $artist_name) {
            $this->command->info("Finding: $artist_name's Albums");

           // Retrieve artist data from Spotify API.
            $artistData = $spotify->searchArtist($artist_name);

            // Check if artist data was found.
            if (!$artistData) {
                $this->command->error("  - Artist not found: $artist_name");
                continue; 
            }

            // Process genres for the artist's albums.
            $unprocessedGenres = $artistData['genres'] ?? [];
            $albumGenre = !empty($unprocessedGenres) ? ucwords($unprocessedGenres[0]) : 'Alternative';

            // Create or update the artist in the database with the retrieved data.
            $artist = Artist::updateOrCreate(
                ['artist_name' => $artistData['name']],
                ['image_url' => $artistData['image_url']] 
            );
            
            // Log the found artist ID.
            $this->command->info("  - Found ID: " . $artist->id);

            // Retrieve the artist's albums from Spotify API.
            $albums = $spotify->getArtistAlbums($artistData['id']);

            // Check if albums were found.
             if (empty($albums)) {
                $this->command->warn(" .. Skipping as no albums could be found.");
                continue;
            }

            // Process each album retrieved from Spotify API.
            foreach ($albums as $spotifyAlbum) {
                // Retrieve album cover from Spotify API.
                $imageUrl = $spotifyAlbum['images'][0]['url'] ?? null;
                $unformattedData = $spotifyAlbum['release_date'];
                $preciseData = $spotifyAlbum['release_date_precision'];

                // Format release date for display on the album show page.
                $formattedData = $unformattedData;
                if ($preciseData === 'year') {
                    $formattedData .= '-01-01';
                } elseif ($preciseData === 'month') {
                    $formattedData .= '-01';    
                }


                // Create or update the album in the database with relevant parameters.
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

                // Display the retrieved album title in terminal.
                $this->command->info("    - Album: " . $album->title);

                // Seed songs for the album if none are present.
                if (Song::where('album_id', $album->id)->count() === 0) {
                    // Retrieve tracks for the album from Spotify API.
                    $tracks = $spotify->getAlbumTracks($spotifyAlbum['id']);
                    // Create song entries in the database for each track in the retrieved album.
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