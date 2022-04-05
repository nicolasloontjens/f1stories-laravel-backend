<?php

namespace App\Http\Controllers;

use App\Modules\Comments\Services\CommentService;
use Illuminate\Http\Request;

class CommentApiController extends Controller
{
    private $service;

    public function __construct(CommentService $service){
        $this->service = $service;
    }

    public function all($id){
        return $this->service->all($id);
    }
}
