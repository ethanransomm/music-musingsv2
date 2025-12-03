<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Album;
use App\Models\Rate;

class CreateReview extends Component
{
    public $score = 0;
    public $title = '';
    public $comment = '';
    public $album_id = '';

    public $albumSearch = '';
    public $selectedAlbumTitle = '';
    public $showDropdown = false;

    protected $rules = [
        'album_id' => 'required|exists:albums,id',
        'score' => 'required|integer|min:1|max:10',
        'title' => 'required|string|min:3',
        'comment' => 'required|string|min:10',
    ];

    public function selectAlbum($id)
    {
        $album = Album::find($id);
        if ($album) {
            $this->album_id = $album->id;
            $this->selectedAlbumTitle = $album->title;
            $this->albumSearch = '';
            $this->showDropdown = false;
        }
    }

    public function setRating($val)
    {
        $this->score = $val;
    }

    public function save()
    {
        $this->validate();


        Rate::create([
            'user_id' => auth()->id(),
            'album_id' => $this->album_id,
            'score' => $this->score,
            'comment' => $this->comment,
        ]);

        return redirect()->route('forum.index')->with('success', 'Review added successfully!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $searchResults = collect();
        if (strlen($this->albumSearch) > 1) {
            $searchResults = Album::where('title', 'like', '%' . $this->albumSearch . '%')
                ->take(5)
                ->get();
        }
        return view('livewire.create-review', [
            'searchResults' => $searchResults
        ]);
    }
}
