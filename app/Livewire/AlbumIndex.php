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

    public function updatedSearch() 
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')] 
   public function render()
    {
        $albums = Album::query()
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                      ->orWhereHas('artist', function($q) {
                          $q->where('artistName', 'like', '%'.$this->search.'%');
                      });
            })
            ->latest()
            ->paginate(24);

        return view('livewire.album-index', [
            'albums' => $albums
        ]);
    }
}
