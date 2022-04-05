<?php

namespace App\Modules\Comments\Services;

use App\Modules\Comments\Models\Comment;
use App\Modules\Core\Services\Service;
use App\Modules\Stories\Models\Story;
use App\Models\User;
use Response;
use stdClass;
use Validator;

class CommentService extends Service{

    protected $rules = [
        "content"=>"required|string"
    ];

    public function __construct(Comment $model){
        parent::__construct($model);
    }

    public function all($storyid){
        $comments = Comment::with('user')->where('story_id',$storyid)->get();
        $res = [];
        foreach($comments as $comment){
            $res[] = $this->convertToRightFormat($comment);
        }
        return $res;
    }

    public function post($storyid, $uid, $comment){
        $validator = Validator::make($comment,$this->rules);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $storytoupdate = Story::find($storyid);
        if($storytoupdate == null){
            return Response::json(['Error'=>'Post does not exist'],400);
        }
        $c = new Comment;
        $c->user_id = $uid;
        $c->story_id = $storyid;
        $c->content = $comment['content'];
        $c->save();
        return $this->convertToRightFormat(Comment::with('user')->where('id',$c->id)->first());
    }

    public function convertToRightFormat($comment){
        $c = new stdClass;
        $c->commentid = $comment['id'];
        $c->userid = $comment['user']['id'];
        $c->storyid = $comment['story_id'];
        $c->content = $comment['content'];
        $c->username = $comment['user']['username'];
        return $c;
    }
}
