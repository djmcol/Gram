<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    private $user;
    private $followers;

    /**
     * @param $user
     * @param $followers
     */
    public function __construct(User $user, Followers $followers)
    {
        $this->user = $user;
        $this->followers = $followers;
    }

    public function index($nick_name)
    {
        $user = $this->user->where('nick_name', $nick_name)->first();

        $followers = $user->followers()->count();
        $followed = $this->followers->where('follower_id', $user->id)->count();
        $postsCount = $user->posts()->count();
        $post = Posts::getPosts($user->id, true);

        return Inertia::render('UserProfile/index', [
            'userProfile' => $user,
            'followers' => $followers,
            'followed' => $followed,
            'postsCount' => $postsCount,
            'posts' => $post,

        ]);
    }

    public function followUser(Request $request)
    {
        return $this->followers->follow($request->user_id);
    }

    public function unFollow(Request $request)
    {
        $follow = $this->followers->where('user_id', $request->user_id)->where('follower_id', auth()->user()->id)->first();
        return $follow->delete();
    }

    public function existsFollow($user_id){
        return $this->followers->where('user_id', $user_id )->where('follower_id', auth()->user()->id)->exists()
            ? ['exists' => true] : ['exists' => false];
    }


}
