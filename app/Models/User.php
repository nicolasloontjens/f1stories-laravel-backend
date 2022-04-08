<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function stories(){
        return $this->hasMany(Story::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function interacts(){
        return $this->hasMany(UserInteracts::class);
    }

    public function races(){
        return $this->hasMany(UserRaces::class);
    }
}
