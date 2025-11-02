<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    //

    public function rate()
    {
        return $this->hasMany(Rate::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function album(){
        return $this->belongsTo(Album::class);
    }
    


}
