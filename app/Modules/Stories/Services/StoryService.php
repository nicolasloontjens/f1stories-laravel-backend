<?php

namespace App\Modules\Stories\Services;

use App\Models\User;
use App\Modules\Core\Services\Service;
use App\Modules\Stories\Models\Story;
use App\Modules\Stories\Models\StoryImages;
use App\Modules\Users\Models\UserInteracts;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use stdClass;

class StoryService extends Service{

    protected $rules = [
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
            $newposts[] = $this->convertToRightFormat($post, StoryImages::where("story_id",$post->id)->first());
        }
        return $newposts;
    }

    public function add($uid, $story, $images){
        $validator = Validator::make($story,$this->rules);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $newstory = new Story;
        $newstory->content = $story['content'];
        $newstory->country = $story['country'];
        $newstory->race_id = $story['raceid'];
        $newstory->score = 0;
        $newstory->user_id = $uid;
        $newstory->save();
        $storyimages = new StoryImages;
        if($images != null){
            $storyimages->story_id = $newstory->id;
            for($i = 0; $i < count($images); $i++){
                $imgpath = $images[$i]->store('userimages');
                if($i == 0) $storyimages->image1 = $imgpath;
                if($i == 1) $storyimages->image2 = $imgpath;
                if($i == 2) $storyimages->image3 = $imgpath;
                $storyimages->save();
            }
        }
        return $this->convertToRightFormat($newstory, $storyimages);
    }

    public function update($uid, $storyid, $story){
        $validator = Validator::make($story,["content" => "required|string"]);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $storytoupdate = $this->model::find($storyid);
        if($storytoupdate == null){
            return Response::json(['Error'=>'Story does not exist'],400);
        }
        if($storytoupdate['user_id'] != $uid){
            return Response::json(['Error'=>'You are not the owner of this post'],401);
        }
        $storytoupdate->content = $story['content'];
        $storytoupdate->save();
        return $this->convertToRightFormat($storytoupdate, []);
    }

    public function delete($storyid, $uid){
        $storytodelete = $this->model::find($storyid);
        if($storytodelete == null){
            return Response::json(['Error'=>'Post does not exist'],400);
        }
        if($storytodelete['user_id'] != $uid){
            return Response::json(['Error'=>'You are not the owner of this post'],401);
        }
        $imagestodelete = StoryImages::where("story_id",$storyid)->first();
        $imagestodelete->delete();
        $storytodelete->delete();
        return Response::json(['message'=>'deleted post!']);
    }

    public function interact($storyid, $uid, $interaction){
        $value = $interaction['interact'];
        $validator = Validator::make($interaction,["interact" => "required|numeric|min:0|max:1"]);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $story = $this->model::find($storyid);
        if($story == null) return Response::json(['Error'=>'Post does not exist'],400);
        if($story['user_id'] != $uid) return Response::json(['Error'=>'You are not the owner of this post'],401);
        $previnteract = UserInteracts::where('user_id',$uid)->where('story_id',$storyid)->first();
        if($previnteract === null){
            if($value == 0){
                return Response::json(["Error"=>"Can't dislike a post you haven't liked"],400);
            }
            $story->score += 1;
            $story->save();
            $interact = new UserInteracts;
            $interact->user_id = $uid;
            $interact->story_id = $storyid;
            $interact->interaction = $value;
            $interact->save();
            return Response::json(["message"=>"interacted with story!"],202);
        }else{
            if($previnteract->interaction == $value){
                return Response::json(["Error"=>"Can't like / dislike, you already liked / disliked"],400);
            }
            $previnteract->interaction = $value;
            $previnteract->save();
            if($value == 1){
                $story->score += 1;
            }
            if($value == 0){
                $story->score -= 1;
            }
            $story->save();
            return Response::json(["message"=>"interacted with story!"],202);
        }
    }

    public function convertToRightFormat($story, $storyimages){
        $s = new stdClass;
        $s->storyid = $story['id'];
        $s->content = $story['content'];
        $s->country = $story['country'];
        $s->raceid = $story['race_id'];
        $s->userid = $story['user_id'];
        $s->score = $story['score'];
        $s->date = $story['created_at'];
        if($storyimages != null){
            $s->image1 = '/' . $storyimages->image1;
            $s->image2 = '/' . $storyimages->image2;
            $s->image3 = '/' . $storyimages->image3;
        }
        $s->username = User::find($story['user_id'])->username;
        return $s;
    }
}
