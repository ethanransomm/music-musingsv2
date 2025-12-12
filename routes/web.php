<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Route;
use App\Models\Album;
use App\Livewire\AlbumIndex;
use App\Livewire\ArtistIndex;
use App\Livewire\ArtistShow;
use Illuminate\Http\Request;
use App\Livewire\Home;

/** Home Routes */
Route::get('/', Home::class)->name('home');
Route::get('/home', Home::class);

/** Artist Routes */
Route::get('/artists', ArtistIndex::class)->name('artists.index');
Route::get('/artist/{artistId}', ArtistShow::class)->name('artist.show');

/** Album Routes */
Route::get('/albums', AlbumIndex::class)->name('albums.index');

Route::get('/album/create', [AlbumController::class, 'create'])->name('albums.create');

Route::post('/album', [AlbumController::class, 'store'])->name('albums.store');

Route::get('/album/{album}', function (Album $album) {
    return view('album', ['album' => $album->load(['songs', 'artist', 'rates.user'])]);
})->name('album.show');

/** Forum Routes */

Route::get('/forum/create', function () {
    return view('forum.create');
})->name('forum.create');

Route::post('/forum/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::delete('/forum/comments/{id}', [CommentController::class, 'delete'])->name('comments.delete');

Route::get('/forum', [RateController::class, 'index'])->name('forum.index');

Route::get('/forum/{id}/edit', [RateController::class, 'edit'])->name('forum.edit');

Route::patch('/forum/{id}', [RateController::class, 'update'])->name('forum.update');
Route::delete('/forum/{id}', [RateController::class, 'delete'])->name('rate.delete');

Route::post('/forum/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::patch('/comments/{id}', [CommentController::class, 'update'])->name('comments.update')->middleware('auth');

/** Notification Route */
Route::post('/notifications/mark-all-read', function (Request $request) {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('mark-as-read');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/** Profile Routes */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/favorites/{album}', [FavouriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavouriteController::class, 'index'])->name('favorites.index');
});

Route::get('/user/{user}', [ProfileController::class, 'show'])->name('profile.show');

/** Profile Picture Routes */
Route::patch('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.picture.update');
Route::delete('/profile/picture', [ProfileController::class, 'deletePicture'])->name('profile.picture.delete');
require __DIR__.'/auth.php';