<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Artist;

class AlbumController extends Controller
{
    

    
    /**
     * Show the form for creating a new album with the artist relationship in tact.
     * @return \Illuminate\View\View The view for creating an album.
     */
    
    public function create()
    {
        $artists = Artist::all();
        return view("albums.create", compact("artists"));
    }

    /**
     * Store a newly created album in storage with validated parameters.
     * @param Request $request The HTTP request to the server.
     */
    public function store(Request $request)
    {

        $validateddata = $request -> validate ([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'artist_id' => 'required|exists:artists,id',
            'genre'=> 'required|string|max:100',
        ]);

        //
    }

    /**
     * Display the specified album by it's id for ease of locating.
     * @param mixed $id the album id.
     * @return mixed the album data.
     */

    public function show($id) {
        // Find and display album by title. 
        $album = Album::where('title', $id)->firstOrFail();
        // Display the album view with the album data.
        return view('album', compact('album'));
    }

    
    public function edit(string $id)
    {
       
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
    
    }
}
