<?php

namespace App\Modules\Stories\Services;

use App\Modules\Core\Services\Service;
use App\Modules\Stories\Models\Story;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use stdClass;

class StoryService extends Service{

    protected $rules = [
        "title" => "required|string",
        "content" => "required|string",
        "country" => "required|string",
        "raceid" => "required|integer"
    ];

    public function __construct(Story $model){
        parent::__construct($model);
    }

    public function all(){
        $posts = $this->model->get();
        $newposts = [];
        foreach($posts as $post){
            $newposts[] = $this->convertToRightFormat($post);
        }
        return $newposts;
    }

    public function add($uid, $story){
        $validator = Validator::make($story,$this->rules);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $newstory = new Story;
        $newstory->title = $story['title'];
        $newstory->content = $story['content'];
        $newstory->country = $story['country'];
        $newstory->race_id = $story['raceid'];
        $newstory->score = 0;
        $newstory->user_id = $uid;
        $newstory->save();
        return $this->convertToRightFormat(($newstory));
    }

    public function update($uid, $storyid, $story){
        $validator = Validator::make($story,["title" => "required|string", "content" => "required|string"]);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $storytoupdate = Story::find($storyid);
        if($storytoupdate == null){
            return Response::json(['Error'=>'Story does not exist'],400);
        }
        if($storytoupdate['user_id'] != $uid){
            return Response::json(['Error'=>'You are not the owner of this post'],401);
        }
        $storytoupdate->title = $story['title'];
        $storytoupdate->content = $story['content'];
        $storytoupdate->save();
        return $this->convertToRightFormat($storytoupdate);
    }

    public function delete($storyid, $uid){
        $storytodelete = Story::find($storyid);
        if($storytodelete == null){
            return Response::json(['Error'=>'Post does not exist'],400);
        }
        if($storytodelete['user_id'] != $uid){
            return Response::json(['Error'=>'You are not the owner of this post'],401);
        }
        return $storytodelete->delete();
    }

    public function convertToRightFormat($story){
        $s = new stdClass;
        $s->storyid = $story['id'];
        $s->title = $story['title'];
        $s->content = $story['content'];
        $s->country = $story['country'];
        $s->raceid = $story['race_id'];
        $s->userid = $story['user_id'];
        $s->score = $story['score'];
        $s->date = $story['created_at'];
        return $s;
    }
}
