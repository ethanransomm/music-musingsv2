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
    public $content = '';
    public $album_id = '';
    
    protected $rules = [
        'album_id' => 'required|exists:albums,id',
        'score' => 'required|integer|min:1|max:10',
        'title' => 'required|string|min:3',
        'content' => 'required|string|min:10',
    ];

    public function setRating($val)
    {
        // This method is called when a star is clicked
        $this->score = $val;
    }

    public function save()
    {
        $this->validate();

        Rate::create([
            'user_id' => auth()->id(),
            'album_id' => $this->album_id,
            'score' => $this->score,
            'title' => $this->title,
            'comment' => $this->comment, 
        ]);

        return redirect()->route('forum.index')->with('success', 'Review added successfully!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.create-review', [
            'albums' => Album::orderBy('title')->get()
        ]);
    }
}
