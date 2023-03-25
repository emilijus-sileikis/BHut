<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('frontend.cart.index', compact('cart'));
    }

    public function remove(int $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();
        return redirect()->back();
    }
}
