<?php

namespace App\Modules\Stories\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function race(){
        return $this->belongsTo(Race::class);
    }

    public function images(){
        return $this->hasOne(StoryImages::class);
    }

    public function interacts(){
        return $this->hasMany(UserInteracts::class);
    }
}
