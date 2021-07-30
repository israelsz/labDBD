<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory;
<<<<<<< Updated upstream
    use SoftDeletes;
=======
    public function videoCategory(){
        return $this->hasMany(VideoCategory::class);
    }


>>>>>>> Stashed changes
}
