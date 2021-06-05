<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Comment;

class SinglePostController extends Controller
{
    public function __invoke($id)
    {
        $post = Post::where('id', '=', $id)->first();
        $comments = Comment::where('post_id', '=', $id)->get();

        return view( 'single_post', ['post' => $post, 'comments'=>$comments]);
    }
}
