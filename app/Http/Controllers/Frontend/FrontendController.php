<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        $categories = Category::where('status','0')->get();
        $products = Product::where('status','0')->orderBy('id','DESC')->limit(4)->get();

        return view('frontend.index', compact('sliders', 'categories', 'products'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();

        return view('frontend.categories.category.index', compact('categories'));
    }

    public function products($category_slug, Request $request)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            $products = $category->products()->where('status','0');

            // Added price sorting
            $this->addedPriceSorting($request, $products);

            $products = $products->paginate(8);

            return view('frontend.categories.products.index', compact('category', 'products'));
        }
        else return redirect()->back();
    }

    public function all(Request $request)
    {
        $categories = Category::all();
        $products = Product::where('status', '0');

        // Category sorting
        if ($request->filled('category')) {
            $category_ids = $request->input('category');
            if(in_array('all', $category_ids)){
                $products->whereIn('category_id', $categories->pluck('id'));
            } else {
                $products->whereIn('category_id', $category_ids);
            }
        }

        // Added price sorting
        $this->addedPriceSorting($request, $products);

        if ($request->ajax()) {
            $products = $products->paginate(8);
            return view('frontend.products._products', compact('products'))->render();
        }

        $products = $products->paginate(8);
        return view('frontend.products.all', compact('categories', 'products'));
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {

            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();

            if ($product) {
                return view('frontend.categories.products.view', compact('product', 'category'));
            }
            else {
                return redirect()->back();
            }

        }
        else {
            return redirect()->back();
        }
    }

    public function searchProducts(Request $request)
    {

        $validatedData = $request->validate([
            'search' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-zA-Z0-9\s\-\.,]+$/', $value)) {
                        $fail('Please use only alphanumeric characters, spaces, hyphens, periods, and commas.');
                    }
                },
            ],
        ]);

        $search = e($validatedData['search']); // Escape the input using Laravel's e() function

        if ($request->search) {
            $searchProducts = Product::where('name', 'LIKE', '%'.$request->search.'%')->latest()->paginate(4);
            return view('frontend.pages.search', compact('searchProducts'));
        }
        else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }

    /**
     * @param Request $request
     * @param $products
     * @return void
     */
    public function addedPriceSorting(Request $request, $products): void
    {
        if ($request->filled('price_sort')) {
            $priceSort = $request->input('price_sort');
            if (in_array($priceSort, ['asc', 'desc'])) {
                $products->orderBy('selling_price', $priceSort);
            }
        }

        // Added quantity sorting
        if ($request->filled('qty_sort')) {
            $qtySort = $request->input('qty_sort');
            if (in_array($qtySort, ['asc', 'desc'])) {
                $products->orderBy('quantity', $qtySort);
            }
        }
    }

    public function thankYou()
    {
        return view('frontend.thankyou');
    }
}
