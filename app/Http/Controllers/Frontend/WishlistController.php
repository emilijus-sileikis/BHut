<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        return view('frontend.wishlist.index');
    }

    public function addToWishlist(Request $request)
    {

        if (Auth::check()) {

            $product = Product::findOrFail($request->product_id);

            if (Wishlist::where('user_id', auth()->user()->getAuthIdentifier())->where('product_id', $request->product_id)->exists())
            {
                return response()->json(['error' => 'Product not found.']);
            }

            if ($product) {

                $user = Auth::user();

                // create the wishlist record
                Wishlist::create([
                    'user_id' => $user->getAuthIdentifier(),
                    'product_id' => $request->product_id
                ]);

                $count = Wishlist::where('user_id', $user->getAuthIdentifier())->get()->count();

                return response()->json(['count' => $count]);
            } else {
                return response()->json(['error' => 'Product not found.']);
            }
        } else {
            return response()->json(['redirect' => route('login')]);
        }
    }

    public function getWishlistCount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $count = Wishlist::where('user_id', $user->getAuthIdentifier())->get()->count();
            return response()->json(['count' => $count]);
        } else {
            return response()->json(['count' => 0]);
        }
    }

    public function removeWishlist()
    {

    }
}
