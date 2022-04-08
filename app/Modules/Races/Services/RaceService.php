<?php

namespace App\Modules\Races\Services;

use App\Modules\Core\Services\Service;
use App\Modules\Races\Models\Race;

class RaceService extends Service{

    protected $rules = [];

    public function __construct(Race $model){
        parent::__construct($model);
    }

    public function get(){
        return $this->model->get();
    }
}
