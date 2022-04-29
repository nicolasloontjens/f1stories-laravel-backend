<?php

namespace App\Modules\Races\Services;

use App\Modules\Core\Services\Service;
use App\Modules\Races\Models\Race;
use App\Modules\Races\Models\RaceLanguage;
use Response;

class RaceService extends Service{

    protected $rules = [];
    private $languageModel;
    private $languages = ['en','nl','fr'];

    public function __construct(Race $model, RaceLanguage $languageModel){
        parent::__construct($model);
        $this->languageModel = $languageModel;
    }

    public function get($language){
        if(!in_array($language,$this->languages)){
            return Response::json(['error'=>'Language not supported'],400);
        }
        if($language == 'en'){
            return $this->model->get(['id as raceid','title','date']);
        }
        $races = $this->languageModel::where('language',$language)->get(['id as raceid','title','date']);
        return $races;
    }
}
