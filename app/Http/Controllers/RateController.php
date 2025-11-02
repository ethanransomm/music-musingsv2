<?php

namespace App\Http\Controllers;
use App\Models\Rate;
use App\Models\User;
use App\Model\Album;

use Illuminate\Http\Request;

class RateController extends Controller
{
    //

    public function index()
    {
        $rates = Rate::with('user', 'album')->latest()->get();
        return view('forum.index', ['rates' => $rates]);
    }

    public function store(Request $request){
        $rate = Rate::create($request->all());
        return redirect()->route('forum.store')->with('success','');
    }
}
