<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory;
    use SoftDeletes;

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
