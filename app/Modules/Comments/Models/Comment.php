<?php

namespace App\Modules\Comments\Models;

use App\Models\User;
use App\Modules\Stories\Models\Story;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function story(){
        return $this->belongsTo(Story::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
