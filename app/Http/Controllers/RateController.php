<?php

namespace App\Http\Controllers;
use App\Models\Rate;
use App\Models\User;
use App\Models\Album;

use Illuminate\Http\Request;

class RateController extends Controller
{
    //

    public function index()
    {
        $rates = Rate::with('user', 'album')->latest()->get();
        return view('forum.index', ['rates' => $rates]);
    }

    // public function store(Request $request){


        // $validated = $request->validate([
           // 'score' => 'required|integer|min:1|max:10',
           // 'comment' => 'nullable|string',
      //  ]);

       

        // return redirect()->route('forum.index')->with('success', 'Rating saved.');
    // }

    // public function create()
    // {
        // $albums = Album::select('id', 'title')->orderBy('title')->get();
        // return view('forum.create', compact('albums'));
        //
   // }
}
