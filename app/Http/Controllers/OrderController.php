<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class OrderController extends Controller
{
    public function __invoke(Request $request){
        $this->validate($request, [
           'first_name' => 'required | max:100 | string',
           'last_name' => 'required | max:100 | string',
           'phone' => 'required | size:12',
           'address' => 'required | max:300 | string',
           'notes' => 'max:500 | string',
        ]);

        $order = new Order();
        $order->first_name = $request->post('first_name');
        $order->last_name = $request->post('last_name');
        $order->phone = $request->post('phone');
        $order->address = $request->post('address');
        $order->notes = $request->post('notes');
        $order->cart = \Cart::getContent()->toJson();
        try {
            $order->save();
        }catch (Exception $exception){
            return back()->withErrors(['errors' => $exception-getMessage()]);
        }
        return redirect()->route('order', ['id' => $order->id]);
    }
}
