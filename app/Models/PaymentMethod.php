<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    //Relacion con clase Donation
    public function donation()
    {
        //return $this->hasMany(Donation::class);
    }
}
