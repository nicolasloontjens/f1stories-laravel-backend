<?php

namespace App\Modules\Stories\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryImages extends Model
{
    use HasFactory;

    public function story(){
        return $this->belongsTo(Story::class);
    }
}
