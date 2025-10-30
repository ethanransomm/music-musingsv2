<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;
use App\Models\Artist;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('Home');

Route::get('/Artists', [ArtistController::class, 'index'])->name('artists.index');

Route::get('/Artist/{artistName}', function ($artistName) {
    $artist = Artist::where('artistName', $artistName)->with('albums')->first();
    $artistsCollection = $artist ? collect([$artist]) : collect([]);
    return view('artist', ['albums' => $artistsCollection]);
})->name('artist.show');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
