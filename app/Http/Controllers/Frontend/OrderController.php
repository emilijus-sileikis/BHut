<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->getAuthIdentifier())->orderBy('created_at', 'desc')->paginate(5);
        return view('frontend.orders.index', compact('orders'));
    }

    public function view($order_id)
    {
        $order = Order::where('user_id', Auth::user()->getAuthIdentifier())->where('id', $order_id)->first();

        if ($order) {
            return view('frontend.orders.view', compact('order'));
        } else {
            return redirect()->back();
        }

    }
}
