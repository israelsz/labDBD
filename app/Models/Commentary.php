<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentary extends Model
{
    use HasFactory;
    use SoftDeletes;
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
