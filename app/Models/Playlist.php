<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    //Relacion con clase usuario_playlist
    public function userPlaylist()
    {
        return $this->hasMany(UserPlaylist::class);
    }

    public function donation()
    {
        return $this->hasMany(Donation::class);
    }

    //Relacion con clase playlist_video
    public function playlistVideo()
    {
        return $this->hasMany(PlaylistVideo::class);
    }
}
