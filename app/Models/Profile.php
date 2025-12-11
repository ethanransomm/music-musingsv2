<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{

    // Model fillable attributes.
    protected $fillable = [
        'user_id',
        'bio',
        'profile_picture',
    ];

    // A profile belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
