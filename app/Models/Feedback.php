<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    //Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relación con Video
    public function video()
    {
        return $this->belongsTo(video::class);
    }
}
