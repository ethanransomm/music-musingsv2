<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Displays a listing of the artists.
     * @return \Illuminate\View\View The view for the artists index page.
     */
    public function index()
    {
        // Retrieve all artists in database.
        $artists = Artist::all();
        // Return the artists index with the artists data and album data.
        return view("artists.index", ["artists"=> $artists], ["albums"=> Album::all()]);
    }

   
    public function create()
    {
        
    }
    public function store(Request $request)
    {
       
    }

    public function show(string $id)
    {
        
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
