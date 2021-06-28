<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderReceivedController extends Controller
{
    public function __invoke($id){
        $order = Order::find($id);
        return view('order_received', ['order' => $order]);
    }
}
