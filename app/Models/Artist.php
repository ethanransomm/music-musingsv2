<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Album;

class Artist extends Model
{


    use HasFactory;

    protected $fillable = [
        'artistName',
        'genre',
        'image_url',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

}


