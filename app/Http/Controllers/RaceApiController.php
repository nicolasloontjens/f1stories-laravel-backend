<?php

namespace App\Http\Controllers;

use App;
use App\Modules\Races\Services\RaceService;
use Illuminate\Http\Request;

class RaceApiController extends Controller{
    private $service;

    public function __construct(RaceService $service){
        $this->service = $service;
    }

    public function get(Request $request){
        $locale = App::getLocale();
        $language = $request->input('lang', $locale);
        if($language != $locale)
            App::setLocale($language);
        return $this->service->get($language);
    }
}
