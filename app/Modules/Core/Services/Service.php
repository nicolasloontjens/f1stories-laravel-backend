<?php

namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;

abstract class Service{
    private $errors;
    private $result;
    protected $rules = [];
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
        $this->errors = [];
        $this->result = [];
    }

    protected function hasErrors(){
        return count($this->errors) > 0;
    }

    protected function getErrors(){
        return $this->errors;
    }

    protected function getResult(){
        return $this->result;
    }
}
