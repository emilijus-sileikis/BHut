<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        $categories = Category::all();
        $products = Product::orderBy('id','DESC')->limit(4)->get();

        return view('frontend.index', compact('sliders', 'categories', 'products'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();

        return view('frontend.categories.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            $products = $category->products()->get();

            return view('frontend.categories.products.index', compact('products', 'category'));
        }
        else {
            return redirect()->back();
        }
    }

    public function all()
    {
        $categories = Category::all();
        $products = Product::orderBy('id','DESC')->paginate(4);

        return view('frontend.products.all', ['categories' => $categories], ['products' => $products]);
    }
}
