<?php

namespace App\Http\Controllers;

use App\Modules\Races\Services\RaceService;

class RaceApiController extends Controller{
    private $service;

    public function __construct(RaceService $service){
        $this->service = $service;
    }

    public function get(){
        return $this->service->get();
    }
}
