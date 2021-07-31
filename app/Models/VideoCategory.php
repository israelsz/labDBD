<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function video(){
        return $this->belongsTo(Video::class);
    }
}
