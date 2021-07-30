<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;

    //Relacion con clase Commune
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    //Relacion con clase Commentary
    public function commentary()
    {
        return $this->hasMany(Commentary::class);
    }

    //Relacion con clase UserVideo
    public function uservideo()
    {
        return $this->hasMany(UserVideo::class);
    }

    //Relacion con clase User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relacion con clase Feedback
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    //Relacion con clase playlist_video
    public function playlistvideo()
    {
        return $this->hasMany(PlaylistVideo::class);
    }

    //Relacion con clase donacion
    public function donation()
    {
        return $this->hasMany(donation::class);
    }

    //Relacion con clase video_categoria
    public function videocategory()
    {
        return $this->hasMany(VideoCategory::class);
    }
}
