<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use HasFactory;
    use SoftDeletes;
    //Relacion con clase User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
