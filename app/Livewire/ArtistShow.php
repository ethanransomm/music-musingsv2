<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Artist;

class ArtistShow extends Component
{
    public Artist $artist;

    public function mount($artistId)
    {
        $this->artist = Artist::with('albums')->findOrFail($artistId);
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.artist-show');
    }
}