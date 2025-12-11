<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SpotifyService
{
    protected $clientId;
    protected $clientSecret;
    protected $baseUrl = 'https://api.spotify.com/v1';

    // Constructor to initialize Spotify API with needed credentials.
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    // Get and cache the access token for the Spotify API.
    protected function getAccessToken()
    {
        // Remember the token for 3000 seconds to reduce the number of authentication requests.
        return Cache::remember('spotify_token', 3000, function () {
            // Request a new access token using Client Credentials.
            $response = Http::asForm()
                ->withBasicAuth($this->clientId, $this->clientSecret)
                ->post('https://accounts.spotify.com/api/token', [
                    'grant_type' => 'client_credentials',
                ]);

            // Return the access token from the response.
            return $response->json('access_token');
        });
    }

    /**
     * Makes a GET request to the Spotify API.
     * @param mixed $endpoint The API address endpoint.
     * @param mixed $params The suitable parameters for the API request.
     */
    protected function makeRequest($endpoint, $params = [])
    {
        // Get the cached access token.
        $token = $this->getAccessToken();

        // Make the GET request with retries for robustness.
        $response = Http::withToken($token)
            ->retry(3, 1000)
            ->get("{$this->baseUrl}/{$endpoint}", $params);

        // Return the JSON response if successful.    
        if ($response->successful()) {
            return $response->json();
        }
        // Return an empty array otherwise.
        return [];
    }

    /**
     * Search for an artist by name in the Spotify API.
     * @param mixed $name The artist's name.
     * @return array|null The artist data or null if not found.
     */
    public function searchArtist($name)
    {
        // The API request to search for the artist.
        $data = $this->makeRequest('search', [
            'q' => $name,
            'type' => 'artist',
            'limit' => 1
        ]);

        // Retrieve the first artist from the response.
        $artist = $data['artists']['items'][0] ?? null;
        if ($artist) {
            return [
                'id' => $artist['id'],
                'name' => $artist['name'],
                'image_url' => $artist['images'][0]['url'] ?? null,
                'genres' => $artist['genres'] ?? [],
                'popularity' => $artist['popularity'] ?? 0,
            ];
        }
        return null;
    }

    /**
     * Get albums for a given artist by their Spotify ID.
     * @param mixed $artistId The Spotify artist ID.
     * @return array The list of albums.
     */
    public function getArtistAlbums($artistId)
    {
        // The API request to get the artist's albums.
        $data = $this->makeRequest("artists/{$artistId}/albums", [
            'include_groups' => 'album',
            'limit' => 10
        ]);

        return $data['items'] ?? [];
    }

    /**
     * Get tracks for a given album by the artist's Spotify ID
     * @param mixed $albumId The Spotify album ID.
     * @return array The list of tracks.
     */
    public function getAlbumTracks($albumId)
    {
        // The API request to get the album's tracks from the Spotify API.
        $data = $this->makeRequest("albums/{$albumId}/tracks", [
            'limit' => 20
        ]);

        return $data['items'] ?? [];
    }
}