<?php

namespace App\Modules\Users\Services;

use App\Modules\Core\Services\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Modules\Users\Services\JWT;
use Illuminate\Support\Facades\Hash;
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
            return Response::json(['Error'=>'Username is taken'],401);
        }

        $validator = Validator::make($user,$this->rules);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }

        $newuser = new User;
        $newuser->username = $user['username'];
        $newuser->password = bcrypt($user['password']);
        $newuser->token = "";
        $newuser->userscore = 0;

        $newuser->save();
        $token = $this->generateToken($newuser);
        $newuser->token = $token;
        $newuser->save();

        return Response::json(['token'=>$token],201);
    }

    public function login($user){
        $validator = Validator::make($user,$this->rules);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $actualuser = User::where('username',$user['username'])->first();
        if(Hash::check($user['password'],$actualuser['password'])){
            $token = $this->generateToken($actualuser);
            $actualuser->token = $token;
            $actualuser->save();
            return Response::json(['token'=>$token],202);
        }
        return Response::json(['Error'=>'Wrong credentials'],401);
    }

    private function generateToken($user){
        $jwtuser = new stdClass();
        $jwtuser->uid = $user->id;
        $jwtuser->username = $user['username'];
        $jwtuser->password = $user['password'];
        return JWT::encode($jwtuser,'verysecuresecret');
    }

}
