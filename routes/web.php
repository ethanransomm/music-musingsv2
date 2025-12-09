<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Rate;
use App\Models\Comment;
use App\Livewire\CreateReview;
use App\Livewire\AlbumIndex;
use App\Livewire\ArtistIndex;
use App\Livewire\ArtistShow;
use Illuminate\Http\Request;


use App\Livewire\Home;

Route::get('/', Home::class)->name('home');


Route::get('/home', Home::class);


Route::get('/artists', ArtistIndex::class)->name('artists.index');
Route::get('/artist/{artistId}', ArtistShow::class)->name('artist.show');

Route::get('/albums', AlbumIndex::class)->name('albums.index');

Route::get('/album/create', [AlbumController::class, 'create'])->name('albums.create');
Route::post('/album', [AlbumController::class, 'store'])->name('albums.store');

Route::get('/album/{album}', function (Album $album) {
    return view('album', ['album' => $album->load(['songs', 'artist', 'rates.user'])]);
})->name('album.show');

Route::get('/forum', [RateController::class, 'index'])->name('forum.index');

Route::post('/forum/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/forum/create', CreateReview::class)->name('forum.create');
// Route::post('/forum', [RateController::class, 'store'])->name('forum.store');

Route::get('/forum/{id}/edit', [RateController::class, 'edit'])->name('forum.edit');
Route::patch('/forum/{id}', [RateController::class, 'update'])->name('forum.update');

Route::delete('/forum/{id}', [RateController::class, 'delete']);
Route::post('/forum/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/forum/comments/{id}', [CommentController::class, 'delete'])->name('comments.delete');
Route::patch('/comments/{id}', [CommentController::class, 'update'])->name('comments.update')->middleware('auth');

Route::post('/notifications/mark-all-read', function (Request $request) {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('mark-as-read');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::patch('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.picture.update');
Route::delete('/profile/picture', [ProfileController::class, 'deletePicture'])->name('profile.picture.delete');
    

require __DIR__.'/auth.php';
