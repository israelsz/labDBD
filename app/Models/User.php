<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

   
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

  
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relacion con comunas
    public function commune(){
        return $this->belongsTo(Commune::class);
    }

    public function userType(){
        return $this->belongsTo(UserType::class);
    }

}
