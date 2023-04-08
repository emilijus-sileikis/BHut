<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('frontend.cart.index', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        if (Auth::check()) {
            $product = Product::findOrFail($request->product_id);

            if ($product) {
                // reduce the quantity of the product in the Product table
                $product->quantity -= $request->qty;
                $product->save();

                // create the cart record
                Cart::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->qty,
                ]);

                $user = Auth::user();
                $count = Cart::where('user_id', $user->id)->get()->count();
                $qty = $product->quantity;

                return response()->json(['count' => $count, 'qty' => $qty]);
            } else {
                return response()->json(['error' => 'Product not found.']);
            }
        } else {
            return response()->json(['redirect' => route('login')]);
        }
    }

    public function getCartCount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $count = Cart::where('user_id', $user->id)->get()->count();
            return response()->json(['count' => $count]);
        } else {
            return response()->json(['count' => 0]);
        }
    }

    public function getCartPrice()
    {
        $user = Auth::user();
        $total = 0;
        $cart = Cart::where('user_id', $user->getAuthIdentifier())->get();

        foreach ($cart as $item) {
            $total += $item->product->selling_price * $item->quantity;
        }

        return response()->json(['count' => $total]);
    }

    public function update(Request $request)
    {
        $quantities = $request->input('quantities');
        $itemIds = $request->input('itemIds');

        // Loop through the item IDs and update the quantities
        for ($i = 0; $i < count($itemIds); $i++) {
            $cartItem = Cart::find($itemIds[$i]);

            if ($cartItem) {
                $cartItem->quantity = $quantities[$i];
                $cartItem->save();
            }
        }

        return response()->json(['success' => true]);
    }

    public function remove(int $id)
    {
        $cartItem = Cart::findOrFail($id);
        $product = Product::findOrFail($cartItem->product_id);

        if ($product) {
            // add the quantity of the product back
            $product->quantity += $cartItem->quantity;
            $product->save();
        }

        $cartItem->delete();
        return redirect()->back();
    }
}
