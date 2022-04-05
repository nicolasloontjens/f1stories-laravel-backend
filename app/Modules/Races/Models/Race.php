<?php

namespace App\Modules\Races\Models;

use App\Modules\Users\Models\UserRaces;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    public function userraces(){
        return $this->hasMany(UserRaces::class);
    }
}
