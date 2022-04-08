<?php

namespace App\Http\Controllers;

use App\Modules\Comments\Services\CommentService;
use App\Modules\Users\Services\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CommentApiController extends Controller
{
    private $service;

    public function __construct(CommentService $service){
        $this->service = $service;
    }

    public function all($id){
        return $this->service->all($id);
    }

    public function post($id, Request $request){
        if(!$request->hasHeader('Authorization')){
            return Response::json(['Error'=>'No token found'],401);
        }
        $uid = JWT::decode($request->header('Authorization'),'verysecuresecret');
        return $this->service->post($id, $uid->uid, $request->all());
    }

    public function update($id, Request $request){
        if(!$request->hasHeader('Authorization')){
            return Response::json(['Error'=>'No token found'],401);
        }
        $uid = JWT::decode($request->header('Authorization'),'verysecuresecret');
        return $this->service->update($id, $uid->uid, $request->all());
    }

    public function delete($id, Request $request){
        if(!$request->hasHeader('Authorization')){
            return Response::json(['Error'=>'No token found'],401);
        }
        $uid = JWT::decode($request->header('Authorization'),'verysecuresecret');
        return $this->service->delete($id, $uid->uid);
    }
}
