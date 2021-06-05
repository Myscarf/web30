<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Сomment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveCommentController extends Controller
{
    public function __invoke(Request $request)
    {
        if (Auth::check()){
            if ($request->method() == 'POST'){
                $comment = new Comment();
                $comment->post_id = $request->input('post_id');
                $comment->author = $request->input('author');
                $comment->comment = $request->input('comment');
                $comment->save();

                return redirect()->route('single_post', $request->input('post_id'));
            }
        }
    }
}
