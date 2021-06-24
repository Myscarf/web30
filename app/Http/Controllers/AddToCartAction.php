<?php

namespace App\Http\Controllers;

use App\Post;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class AddToCartAction extends Controller
{
    public function __invoke(Request $request, $id){
        $post = Post::find($id);
        \Cart::add([
            'id' => $post->id,
            'name' => $post->series,
            'price' => $post->penciler_id,
            'quantity' => 1,
            'attributes' => [
                'cover'=>$post->cover,
                'issue' => $post->issue,
            ],
        ]);
    \Session::flash('flash', $post->series . ' #' . $post->issue . ' добавлен в корзину');
    return back();
    }
}
