<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Album;

class Artists extends Model
{

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    //
}
