<?php

namespace App\Http\Controllers;

use App\Modules\Users\Services\JWT;
use Illuminate\Http\Request;
use App\Modules\Users\Services\UserService;
use Response;

class UserApiController extends Controller
{
    private $service;

    public function __construct(UserService $service){
        $this->service = $service;
    }

    public function register(Request $request){
        $data = $request->only(['username','password']);
        $res = $this->service->register($data);
        return $res;
    }

    public function login(Request $request){
        $data = $request->only(['username','password']);
        $res = $this->service->login($data);
        return $res;
    }

    public function getUser($id){
        $res = $this->service->getUser($id);
        return $res;
    }

    public function addRace($id, Request $request){
        if(!$request->hasHeader('Authorization')){
            return Response::json(['Error'=>'No token found'],401);
        }
        $uid = JWT::decode($request->header('Authorization'),'verysecuresecret');
        $res = $this->service->addRace($id, $uid->uid, $request->all());
        return $res;
    }
}
