<?php

namespace App\Modules\Users\Services;

use App\Modules\Core\Services\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Modules\Users\Services\JWT;
use stdClass;

class UserService extends Service{

    protected $rules = [
        "username" => "required",
        "password" => "required"
    ];

    public function __construct(User $model){
        parent::__construct($model);
    }

    public function register($user){
        if(User::where('username',$user['username'])->first() != null){
            return Response::json(['Error'=>'Username is taken'],404);
        }

        $validator = Validator::make($user,$this->rules);
        if($validator->fails()){
            return;
        }

        $newuser = new User;
        $newuser->username = $user['username'];
        $newuser->password = bcrypt($user['password']);
        $newuser->token = "";
        $newuser->userscore = 0;

        $newuser->save();

        $jwtuser = new stdClass();
        $jwtuser->id = $newuser->id;
        $jwtuser->username = $user['username'];
        $jwtuser->password = $user['password'];

        $token = JWT::encode($jwtuser,"verysecurekey");

        $newuser->token = $token;
        $newuser->save();

        return $token;
    }

    public function login($user){
        
    }

}
