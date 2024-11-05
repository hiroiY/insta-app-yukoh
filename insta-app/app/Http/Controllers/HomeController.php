<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;  // this is the post model represents the [posts table]
use App\Models\User;
use App\Models\Follow;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     private $post;
     private $user;
     private $follow;


    public function __construct(Post $post, User $user, Follow $follow)
    {
        $this->post = $post;
        $this->user = $user;
        $this->follow = $follow;
    }

    # Get all the posts of the users the AUTH USER is following
    private function getHomePosts() 
    {
        $all_posts = $this->post->latest()->get(); // SELECT * FROM posts ORDER BY created_at DESC
        $home_posts = []; //this will be a container that will hold the filtered posts

        foreach($all_posts as $post) {
            if($post->user->isFollowed() || $post->user->id === Auth::user()->id){
                $home_posts[] = $post;
            }
        }
        return $home_posts; // this $home_posts now contains the post of the user being followed by the logged-in user and the posts of the current logged-in
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     # Get users that the Auth USER is not following
     public function getSuggestedUsers() {

        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user) {
            # if the AUTH user is not following the $user, save the $user in the $suggested_users.
            if($user != $user->isFollowed()) // same : !$user->isFollowed()
            {
                $suggested_users[] = $user;
            }
        }
        return array_slice($suggested_users,0,5);
        # array_slice(x,y,z)
        # x --> name of the array
        # y --> the offset (where to start)
        # z --> how many users to get (Limit)
     }


    public function index()
    {
        // $all_posts = $this->post->latest()->get();
        // #SAME AS : SELECT * FROM posts ORDER BY created_at DESC

        $home_posts = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers();

        return view('users.home')
                ->with('home_posts', $home_posts)
                ->with('suggested_users', $suggested_users);

    }
    
    public function suggestions() {
        
        $suggested_users = $this->getSuggestedUsers();
        

        return view('users.suggestion')
                ->with('suggested_users', $suggested_users);
    }

    // This will received the user being search coming from the form in app.blade.php
    public function search(Request $request) {
        $users = $this->user->where('name','like','%'. $request->search .'%')->get();
        return view('users.search')->with('users',$users)->with('search', $request->search);
    }

}
