<?php

namespace App\Http\Controllers;

use App\Modules\Stories\Services\StoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Modules\Users\Services\JWT;
use stdClass;

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
        if(!$request->hasHeader('Authorization')){
            return Response::json(['Error'=>'No token found'],401);
        }
        $uid = JWT::decode($request->header('Authorization'),'verysecuresecret');
        return $this->service->update($uid->uid,$id,$request->all());
    }

    public function delete($id, Request $request){
        if(!$request->hasHeader('Authorization')){
            return Response::json(['Error'=>'No token found'],401);
        }
        $uid = JWT::decode($request->header('Authorization'),'verysecuresecret');
        return $this->service->delete($id, $uid->uid);
    }

    public function interact($id, Request $request){
        if(!$request->hasHeader('Authorization')){
            return Response::json(['Error'=>'No token found'],401);
        }
        $uid = JWT::decode($request->header('Authorization'),'verysecuresecret');
        return $this->service->interact($id, $uid->uid, $request->all());
    }
}
