<?php

namespace App\Modules\Users\Services;

use App\Modules\Core\Services\Service;
use App\Models\User;
use App\Modules\Races\Models\Race;
use App\Modules\Stories\Models\Story;
use App\Modules\Stories\Models\StoryImages;
use App\Modules\Users\Models\UserInteracts;
use App\Modules\Users\Models\UserRaces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Jwt;
use Illuminate\Support\Facades\Hash;
use stdClass;
use Storage;

class UserService extends Service{

    protected $rules = [
        "username" => "required",
        "password" => "required"
    ];

    public function __construct(User $model){
        parent::__construct($model);
    }

    public function register($user){
        if(User::where('username',$user['username'])->first() != null){
            return Response::json(['Error'=>'Username is taken'],401);
        }

        $validator = Validator::make($user,$this->rules);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }

        $newuser = new User;
        $newuser->username = $user['username'];
        $newuser->password = bcrypt($user['password']);
        $newuser->token = "";
        $newuser->userscore = 0;

        $newuser->save();
        $token = $this->generateToken($newuser);
        $newuser->token = $token;
        $newuser->save();

        return Response::json(['token'=>$token],201);
    }

    public function login($user){
        $validator = Validator::make($user,$this->rules);
        if($validator->fails()){
            return Response::json(['Error'=>'Bad Request'],400);
        }
        $actualuser = User::where('username',$user['username'])->first();
        if(Hash::check($user['password'],$actualuser['password'])){
            $token = $this->generateToken($actualuser);
            $actualuser->token = $token;
            $actualuser->save();
            return Response::json(['token'=>$token],202);
        }
        return Response::json(['Error'=>'Wrong credentials'],401);
    }

    public function getUser($id){
        $user = $this->model::find($id);

        $totalraces = UserRaces::where("user_id",$id)->get();
        $stories = Story::where("user_id",$id)->get();
        $score = $stories->sum("score");
        $formattedstories = [];
        foreach($stories as $story){
            $storyimages = null;
            $storyimages = StoryImages::where("story_id",$story->id)->first();
            $formattedstories[] = $this->convertToRightFormat($story, $storyimages);
        }
        $user->stories = $formattedstories;
        $user->racesvisited = $totalraces->count();
        $user->userscore = $score;
        return $user;
    }

    public function addRace($id, $uid, $body){
        $user = $this->model::find($id);
        if($user == null) return Response::json(['Error'=>'User does not exist'],400);
        if($user['id'] != $uid) return Response::json(['Error'=>'You are not this user'],401);
        $race = Race::where("title",$body)->first();
        if($race === null){
            return Response::json(['Error'=>'Race does not exist'],401);
        }
        $userrace = new UserRaces;
        $userrace->user_id = $uid;
        $userrace->race_id = $race->id;
        $userrace->save();
        return Response::json(['message'=>'added race'],202);
    }

    public function getLikes($id){
        return UserInteracts::select('story_id AS storyid','interaction')->where('user_id',$id)->get();
    }

    private function generateToken($user){
        $jwtuser = new stdClass();
        $jwtuser->uid = $user->id;
        $jwtuser->username = $user['username'];
        $jwtuser->password = $user['password'];
        return JWT::encode($jwtuser,'verysecuresecret');
    }

    private function convertToRightFormat($story, $storyimages){
        $s = new stdClass;
        $s->storyid = $story['id'];
        $s->title = $story['title'];
        $s->content = $story['content'];
        $s->country = $story['country'];
        $s->raceid = $story['race_id'];
        $s->userid = $story['user_id'];
        $s->score = $story['score'];
        $s->date = $story['created_at'];
        if($storyimages != null){
            if($storyimages->image1!=null){
                $s->image1 = Storage::disk('s3')->url($storyimages->image1);
            }
            if($storyimages->image2!=null){
                $s->image2 = Storage::disk('s3')->url($storyimages->image2);
            }
            if($storyimages->image3!=null){
                $s->image3 = Storage::disk('s3')->url($storyimages->image3);
            }
        }
        return $s;
    }

}
