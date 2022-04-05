<?php

namespace App\Http\Controllers;

use App\Modules\Stories\Services\StoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Modules\Users\Services\JWT;


class StoryApiController extends Controller
{
    private $service;

    public function __construct(StoryService $service){
        $this->service = $service;
    }

    public function all(){
        return $this->service->all();
    }

    public function add(Request $request){
        if(!$request->hasHeader('Authorization')){
            return Response::json(['Error'=>'No token found'],401);
        }
        $uid = JWT::decode($request->header('Authorization'),'verysecuresecret');
        return $this->service->add($uid->uid,$request->only(['title','content','country','raceid']));
    }

    public function update($id, Request $request){

    }

    public function delete($id){

    }
}
