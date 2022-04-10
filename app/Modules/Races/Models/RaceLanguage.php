<?php

namespace App\Modules\Races\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceLanguage extends Model
{
    use HasFactory;

    protected $table = "races_language";

    public function race(){
        return $this->belongsTo(Race::class);
    }
}
