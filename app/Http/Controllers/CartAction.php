<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CartAction extends Controller
{
    public function add(Request $request, $id)
    {
        $post = Post::find($id);
        \Cart::add([
            'id' => $post->id,
            'name' => $post->series,
            'price' => $post->penciler_id,
            'quantity' => 1,
            'attributes' => [
                'cover' => $post->cover,
                'issue' => $post->issue,
            ],
        ]);
        \Session::flash('flash', $post->series . ' #' . $post->issue . ' добавлен в корзину');
        return back();
    }

    public function show() {
        return view('cart');
    }

    public function delete($id) {
        \Cart::remove($id);
        return back();
    }

    public function update(Request $request) {
        foreach ($request->post() ['items_'] as $id =>$quantity){
            \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $quantity
            ]
            ]);
        }
        return back();
    }
}
