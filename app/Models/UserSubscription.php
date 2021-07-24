<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    //Relacion con clase User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
