<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Album;

class Artist extends Model
{

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    //
}
