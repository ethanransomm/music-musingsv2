<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Rate;

class Home extends Component
{
    #[Layout('layouts.app')] 

    /**
     * Renders the home page with random featured albums and artists, and most recent reviews.
     * @return \Illuminate\Contracts\View\View The home page view.
     */
    public function render()
    {
        return view('livewire.home', [
            // Load 16 random featured albums.
            'featuredAlbums' => Album::inRandomOrder()->take(16)->get(),
            
            // Load the 6 latest featured artists.
            'featuredArtists' => Artist::latest()->take(6)->get(),
            
            // Load the 3 most recent reviews with score 6 or more.
            'recentReviews' => Rate::with('album', 'user')
                                   ->where('score', '>=', 6)
                                   ->latest()
                                   ->take(3)
                                   ->get()
        ]);
    }
}