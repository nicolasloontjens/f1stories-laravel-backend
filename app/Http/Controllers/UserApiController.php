<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Users\Services\UserService;

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

    }
}
