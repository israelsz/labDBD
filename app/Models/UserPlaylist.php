<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlaylist extends Model
{
    use HasFactory;

    //Relación con Playlist
    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }

    //Relación con Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
