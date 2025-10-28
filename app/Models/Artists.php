<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{

    public function albums()
    {
        return $this->hasMany(Albums::class);
    }

    //
}
