<?php

namespace App\Modules\Races\Models;

use App\Modules\Users\Models\UserRaces;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function userraces(){
        return $this->hasMany(UserRaces::class);
    }

    public function translations(){
        return $this->hasMany(RaceLanguage::class);
    }
}
