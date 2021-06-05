<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __invoke()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        return view('news', ['posts' => $posts]);
    }
}
