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

    // Validation rules for the review form.
    protected $rules = [
        'album_id' => 'required|exists:albums,id',
        'score' => 'required|integer|min:1|max:10',
        'title' => 'required|string|min:3',
        'comment' => 'required|string|min:10',
    ];

    /**
     * Finds and selects an album by its ID.
     * @param mixed $id Album ID.
     * @return void Fetches album and sets selected album title.
     */
    public function selectAlbum($id)
    {
        $album = Album::find($id);
        // If album found, set the album ID and title.
        if ($album) {
            $this->album_id = $album->id;
            $this->selectedAlbumTitle = $album->title;
            $this->albumSearch = '';
            $this->showDropdown = false;
        }
    }

    /**
     * Sets the rating score.
     * @param int $val The rating value.
     * @return void Updates the score value.
     */

    public function setRating($val)
    {
        $this->score = $val;
    }
    /**
     * Saves the validated review to the database.
     * @return \Illuminate\Http\RedirectResponse Redirects to forum index with success message.
     */
    public function save()
    {

        // User must be authenticated before allowing review submission.
        if (!auth()->check()) {
            session()->flash('error', 'You must be logged in to submit a review.');
            return redirect()->route('login');
        }

        $this->validate();
        // Check user has not already reviewed the selected album.
        $existingRate = Rate::where('user_id', auth()->id())
            ->where('album_id', $this->album_id)
            ->first();

        // If the user tries to review an album they have already reviewed, redirect back to forum index page with an error.    
        if ($existingRate) {
            return redirect()->route('forum.index')->with('error', 'You have already reviewed this album.');
        }

        // Create the new rate record in the database.
        Rate::create([
            'user_id' => auth()->id(),
            'album_id' => $this->album_id,
            'score' => $this->score,
            'title' => $this->title,
            'comment' => $this->comment,
        ]);

        // Redirect back to forum index page with success message.
        return redirect()->route('forum.index')->with('success', 'Review added successfully!');
    }

    #[Layout('layouts.app')]

    /**
     * Renders the Livewire component view for the review search bar.
     * @return \Illuminate\View\View The view for creating a review.
     */
    public function render()
    {
        // Search for albums matching the search input with input required to be more than 1 character.
        $searchResults = collect();
        if (strlen($this->albumSearch) > 1) {
            // Load albums matching search with related artist.
            $searchResults = Album::with('artist')
                // Filter albums where title matches search input.
                ->where('title', 'like', '%' . $this->albumSearch . '%')
                ->take(5)
                ->get();
        }
        // Return the view with the search results.
        return view('livewire.create-review', [
            'searchResults' => $searchResults
        ]);
    }
}
