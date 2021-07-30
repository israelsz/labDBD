<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory;
    use SoftDeletes;

    //Relacion con clase Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    //Relacion con clase Commune
    public function commune()
    {
        return $this->hasMany(Commune::class);
    }
    
}
