<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVideo extends Model
{
    use HasFactory;

    //Relacion con clase Video
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    //Relacion con clase User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
