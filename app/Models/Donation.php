<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    //Relacion con playlist
    public function playlist()
    {
        return $this->belongsTo(PlaylistVideo::class);
    }

    //Relacion con video
    public function video(){
        return $this->belongsTo(Video::class);
    }

    //Relacion con usuario donador
    public function donorUser()
    {
        return $this->belongsTo(User::class);
    }
    //Relacion con usuario receptor
    public function receivingUser()
    {
        return $this->belongsTo(User::class);
    }
    //Relacion con metodo pago
    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
}
