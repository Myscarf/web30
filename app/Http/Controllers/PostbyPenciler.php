<?php

namespace App\Http\Controllers;

use App\Penciler;
use App\Post;
use Illuminate\Http\Request;

class PostbyPenciler extends Controller
{
        public function __invoke($key){

        $penciler = Penciler::where('key', '=', $key)->first();

        return view('posts_by_penciler', ['penciler' => $penciler]);
    }
}
