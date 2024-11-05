<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like){
        $this->like = $like;
    }

    public function store($post_id)
    {
        $this->like->user_id = Auth::user()->id; //owner of the like
        $this->like->post_id = $post_id;         //the post being liked
        $this->like->save();

        return redirect()->back();
    }
    public function destroy($post_id) {
        $this->like
            ->where('user_id',Auth::user()->id)  //who is the user of the post
            ->where('post_id',$post_id)  //whech post is the like have?
            ->delete();

            return redirect()->back();
    }
}