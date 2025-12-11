<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Artist;

class ArtistIndex extends Component
{
    use WithPagination;

    public $search = '';

    // Reset pagination when search is updated.
    public function updatedSearch() 
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')] 
    /**
     * Finds artists based on search.
     * @return \Illuminate\Contracts\View\View Load filtered view of artists.
     */
    public function render()
    {
        // Load artists based on search.
        $artists = Artist::query()
            // Fetch number of albums for the artist searched.
            ->withCount('albums')
            // Filter artists by name based on search.
            ->when($this->search, function($query) {
                $query->where('artist_name', 'like', '%'.$this->search.'%');
            })
            // Organise artists alphabetically.
            ->orderBy('artist_name')
            ->paginate(24);
            
        // Return the artist index view with the filtered artists.
        return view('livewire.artist-index', [
            'artists' => $artists
        ]);
    }
}