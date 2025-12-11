<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Artist;

class ArtistShow extends Component
{
    public Artist $artist;

    /**
     * Creates the an instance of the component.
     * @param mixed $artistId Artist identifier.
     * @return void Finds artist by ID with albums.
     */
    public function mount($artistId)
    {
        // Find artist by ID with albums if they exist.
        $this->artist = Artist::with('albums')->findOrFail($artistId);
    }

    #[Layout('layouts.app')] 
    /**
     * Renders the artist show view.
     * @return \Illuminate\Contracts\View\View The artist show view.
     */
    public function render()
    {
        return view('livewire.artist-show');
    }
}