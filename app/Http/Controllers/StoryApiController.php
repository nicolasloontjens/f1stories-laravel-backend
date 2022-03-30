<?php

namespace App\Http\Controllers;

use App\Modules\Stories\Services\StoryService;
use Illuminate\Http\Request;

class StoryApiController extends Controller
{
    private $service;

    public function __construct(StoryService $service){
        $this->service = $service;
    }

    public function all(){
        return $this->service->all();
    }
}
