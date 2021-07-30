<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commune extends Model
{
    use HasFactory;
    use SoftDeletes;

    //Relacion con clase Region
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    //Relacion con clase User
    public function user()
    {
        return $this->hasMany(User::class);
    }

    //Relacion con clase Video
    public function video()
    {
        return $this->hasMany(Video::class);
    }
}
