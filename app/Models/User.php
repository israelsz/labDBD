<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;


    //Relacion con comunas
    public function commune(){
        return $this->belongsTo(Commune::class);
    }

    public function userType(){
        return $this->belongsTo(UserType::class);
    }

}
