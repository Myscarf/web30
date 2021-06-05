<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;

class PostsbyCharacterController extends Controller
{
    public function __invoke($key)
    {
       $character = Character::where('key' , '=' , $key)->first();

       return view('post_by_character', ['character'=>$character]);
    }
}
