<?php

namespace App\Modules\Comments\Services;

use App\Modules\Comments\Models\Comment;
use App\Modules\Core\Services\Service;
use App\Modules\Stories\Models\Story;
use App\Models\User;
use stdClass;

class CommentService extends Service{

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
