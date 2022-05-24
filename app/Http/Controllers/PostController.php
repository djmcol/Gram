<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Comments;
use App\Models\Likes;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $post;
    private $comments;
    private $likes;

    public function __construct(Posts $post, Comments $comments, Likes $likes)
    {
        $this->post = $post;
        $this->comments = $comments;
        $this->likes = $likes;
    }

    public function createPost(ImageRequest $request)
    {
        try {
            DB::beginTransaction();
            $post = $this->post->createPost($request);
            DB::commit();
            return $post;
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function getPosts(){
       return $this->post->getPosts(Auth::id());
    }
}
