<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like($product_id)
    {
        $product = Product::find($product_id);
        $user_id = Auth::id();

        // Check if the user has already liked the product
        $existingLike = $product->likes()->where('user_id', $user_id)->where('like', 1)->first();

        if (!$existingLike) {
            // User has not liked the product before
            $product->likes()->create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'like' => 1,
                'dislike' => 0,
            ]);

            $product->increment('thumbs_up');
        } else {
            // User has already liked the product, remove the like
            $existingLike->delete();
            $product->decrement('thumbs_up');
        }

        return redirect()->back();
    }

    public function dislike($product_id)
    {
        $product = Product::find($product_id);
        $user_id = Auth::id();

        // Check if the user has already disliked the product
        $existingDislike = $product->likes()->where('user_id', $user_id)->where('dislike', 1)->first();

        if (!$existingDislike) {
            // User has not disliked the product before
            $product->likes()->create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'like' => 0,
                'dislike' => 1,
            ]);

            $product->increment('thumbs_down');
        } else {
            // User has already disliked the product, remove the dislike
            $existingDislike->delete();
            $product->decrement('thumbs_down');
        }

        return redirect()->back();
    }

    public function comment(Request $request, $product_id)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $user_id = Auth::id();

        $comment = new Comment;
        $comment->user_id = $user_id;
        $comment->product_id = $product_id;
        $comment->content = $validatedData['content'];
        $comment->save();

        return redirect()->back();
    }

    public function delete(Comment $comment)
    {
        if (Auth::id() == $comment->user_id) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        } else {
            return back()->with('error', 'You are not authorized to delete this comment!');
        }
    }

}
