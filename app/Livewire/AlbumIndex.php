<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination; 
use App\Models\Album;

class AlbumIndex extends Component
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
    * Loads search term on album index page.
    * @return \Illuminate\Contracts\View\View The new view with the search results.
    */
   public function render()
    {
        // Load albums based on search.
        $albums = Album::query()
            // Query to filter albums by title or artist name based on search term input.
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    // Search by related artist name.
                      ->orWhereHas('artist', function($q) {
                        // Filter by artist name matching search term.
                          $q->where('artist_name', 'like', '%'.$this->search.'%');
                      });
            })
            ->latest()
            ->paginate(24);

        // Return the album index view with the filtered albums.    
        return view('livewire.album-index', [
            'albums' => $albums
        ]);
    }
}
