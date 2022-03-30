<?php

namespace App\Modules\Stories\Services;

use App\Modules\Core\Services\Service;
use App\Modules\Stories\Models\Story;

class StoryService extends Service{
    public function __construct(Story $model){
        parent::__construct($model);
    }

    public function all(){
        return $this->model->get();
    }
}
