<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;
use App\Models\Artist;
use App\Models\Album;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('Home');

Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');

Route::get('/artist/{artistName}', function ($artistName) {
    $artist = Artist::where('artistName', $artistName)->with('albums')->first();
    $artistsCollection = $artist ? collect([$artist]) : collect([]);
    return view('artist', ['albums' => $artistsCollection]);
})->name('artist.show');

Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');

Route::get('/album/{title}', function ($title) {
    $album = Album::where('title', $title)->with('songs', 'artist')->first();
    return view('album', ['album' => $album]);
})->name('album.show');

Route::get('/album/create', [AlbumController::class,'index'])->name('album.create');
Route::post('/album/create', [AlbumController::class,'store'])->name('album.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
