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
    public function render()
    {
        return view('livewire.home', [
            'featuredAlbums' => Album::inRandomOrder()->take(8)->get(),
            
            'featuredArtists' => Artist::latest()->take(6)->get(),
            
            'recentReviews' => Rate::with('album', 'user')
                                   ->where('score', '>=', 8)
                                   ->latest()
                                   ->take(3)
                                   ->get()
        ]);
    }
}