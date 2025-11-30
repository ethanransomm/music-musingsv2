<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // public function index()
    // {
       // $albums = Album::all();
        // return view("albums.index", ["albums"=> $albums], ["songs"=> Song::all()]);

        //
    // }

    /**
     * Show the form for creating a new resource.
     */

    
    public function create()
    {
        $artists = Artist::all();
        return view("albums.create", compact("artists"));
        //
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show($id) {
        $album = Album::where('title', $id)->firstOrFail();
        return view('album', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
