<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Albums extends Model
{
    use HasFactory;

    public function artist()
    {
        return $this->belongsTo(Artists::class);
    }

    public function songs()
    {
        return $this->hasMany(Songs::class);
    }
}
