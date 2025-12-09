<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SpotifyService
{
    protected $clientId;
    protected $clientSecret;
    protected $baseUrl = 'https://api.spotify.com/v1';
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    protected function getAccessToken()
    {
        return Cache::remember('spotify_token', 3000, function () {
            $response = Http::asForm()
                ->withBasicAuth($this->clientId, $this->clientSecret)
                ->post('https://accounts.spotify.com/api/token', [
                    'grant_type' => 'client_credentials',
                ]);

            return $response->json('access_token');
        });
    }

    protected function makeRequest($endpoint, $params = [])
    {
        $token = $this->getAccessToken();
        
        $response = Http::withToken($token)
            ->retry(3, 1000) 
            ->get("{$this->baseUrl}/{$endpoint}", $params);

        if ($response->successful()) {
            return $response->json();
        }

        return []; 
    }

    public function searchArtist($name)
{
    $data = $this->makeRequest('search', [
        'q' => $name,
        'type' => 'artist',
        'limit' => 1
    ]);

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

    public function getArtistAlbums($artistId)
    {
        $data = $this->makeRequest("artists/{$artistId}/albums", [
            'include_groups' => 'album',
            'limit' => 10
        ]);

        return $data['items'] ?? [];
    }

    public function getAlbumTracks($albumId)
    {
        $data = $this->makeRequest("albums/{$albumId}/tracks", [
            'limit' => 20
        ]);

        return $data['items'] ?? [];
    }
}