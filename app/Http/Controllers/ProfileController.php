<?php

namespace App\Http\Controllers;

use App\Models\Followers;
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
        $followed = $this->followers->where('follower_id' , $user->id)->count();
        $posts = $user->posts()->count();

        return Inertia::render('UserProfile/index' , [
            'user' => $user,
            'followers' => $followers,
            'followed' => $followed,
            'posts' => $posts
        ]);
    }


}
