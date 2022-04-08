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
        $comments = $this->model::with('user')->where('story_id',$storyid)->get();
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
        $story = Story::find($storyid);
        if($story == null){
            return Response::json(['Error'=>'Story does not exist'],400);
        }
        $c = new Comment;
        $c->user_id = $uid;
        $c->story_id = $storyid;
        $c->content = $comment['content'];
        $c->save();
        return $this->convertToRightFormat($this->model::with('user')->where('id',$c->id)->first());
    }

    public function update($commentid, $uid,$comment){
        $validator = Validator::make($comment,$this->rules);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $commenttoupdate = $this->model::find($commentid);
        if($commenttoupdate == null){
            return Response::json(['Error'=>'Comment does not exist'],400);
        }
        if($commenttoupdate->user_id != $uid){
            return Response::json(['Error'=>'You are not the owner of this comment'],401);
        }
        $commenttoupdate->content = $comment['content'];
        $commenttoupdate->save();
        return $this->convertToRightFormat($this->model::with('user')->where('id',$commentid)->first());
    }

    public function delete($id, $uid){
        $comment = $this->model::find($id);
        if($comment == null){
            return Response::json(['Error'=>'Comment does not exist'],400);
        }
        if($comment->user_id != $uid){
            return Response::json(['Error'=>'You are not the owner of this comment'],401);
        }
        $comment->delete();
        return Response::json(['message'=>'Comment deleted!'],200);
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
