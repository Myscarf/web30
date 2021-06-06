<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class APIAdminController extends Controller
{
    public function create(Request $request){
        $post = new Post();
        $post->penciler_id = $request->post('penciler_id');
        $post->series = $request->post('series');
        $post->cover =  $request->post('image');
        $post->issue = $request->post('issue');
        $post->story_arc = $request->post('story_arc');
        //$post->story_arc-part = $request->post('story_arc-part');
        $post->event = $request->post('event');
        $post->synopsis = $request->post('synopsis');
        $post->save();
        return response()->json($post, 201);
    }
    public function update(Request $request, $id){
        $post = Post::find($id);
        $post->penciler_id = $request->post('penciler_id');
        $post->series = $request->post('series');
        $post->cover =  $request->post('image');
        $post->issue = $request->post('issue');
        $post->story_arc = $request->post('story_arc');
        //$post->story_arc-part = $request->post('story_arc-part');
        $post->event = $request->post('event');
        $post->synopsis = $request->post('synopsis');
        $post->save();
        return response()->json($post, 200);
    }
}
