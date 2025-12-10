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

    public function updatedSearch() 
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')] 
    public function render()
    {
        $artists = Artist::query()
            ->withCount('albums')
            ->when($this->search, function($query) {
                $query->where('artist_name', 'like', '%'.$this->search.'%');
            })
            ->orderBy('artist_name')
            ->paginate(24);

        return view('livewire.artist-index', [
            'artists' => $artists
        ]);
    }
}