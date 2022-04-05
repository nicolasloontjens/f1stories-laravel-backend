<?php

namespace App\Modules\Comments\Services;

use App\Modules\Comments\Models\Comment;
use App\Modules\Core\Services\Service;
use App\Modules\Stories\Models\Story;
use App\Models\User;

class CommentService extends Service{

    protected $rules = [
        "username" => "required",
        "password" => "required"
    ];

    public function __construct(Comment $model){
        parent::__construct($model);
    }

    public function all($storyid){
        return Story::find($storyid)->user();

        return $this->model->where('story_id',$storyid);
    }

    public function convertToRightFormat($comment){

    }
}
