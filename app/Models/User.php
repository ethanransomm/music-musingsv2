<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'user_admin' => 'boolean',
        ];
    }


    // Boot method to create profile on user instantiation.
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            Profile::create(['user_id' => $user->id]);
        });
    }

    // A user has many ratingss.
    public function rates()
    {
        return $this->hasMany(Rate::class, 'user_id');
    }

    // A user has many comments.
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    // A user has one profile.
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    // A user has many favourite albums.
    public function favouriteAlbums()
    {
        return $this->belongsToMany(Album::class, 'user_album_favourites')
            ->withTimestamps();
    }

}


