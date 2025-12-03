<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rate;

class Comment extends Model
{

    protected $fillable = [
        'content',
        'user_id',
        'rate_id',
    ];

    public function rate()
    {
        return $this->belongsTo(Rate::class, 'rate_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
