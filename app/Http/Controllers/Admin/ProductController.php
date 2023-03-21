<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending ? '1':'0',
            'status' => $request->status ? '1':'0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        $this->uploadImage($request, $product);

        return redirect('admin/products')->with('message','Product Added Successfully!');
    }

    public function edit(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();

        $product = Product::where('id', $product_id)->first();

        if ($product) {
            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending ? '1' : '0',
                'status' => $request->status ? '1' : '0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            $this->uploadImage($request, $product);

            return redirect('admin/products')->with('message','Product Updated Successfully!');
        }
        else {
            return redirect('admin/products')->with('message', 'No such product id found');
        }
    }

    public function uploadImage(Request $request, Product $product)
    {
        if($request->hasFile('image')) {

            $uploadPath = 'uploads/products/';

            foreach ($request->file('image') as $file) {

                $validator = Validator::make($request->all(), [
                    'image.*' => 'image|max:4000',
                ]);

                $validatedData = $validator->validated();

                $ext = $file->getClientOriginalExtension();
                $name = rand(1000000, 9999999).'.'.$ext;
                $file->move($uploadPath,$name);
                $finalImagePathName = $uploadPath.$name;

                $product->images()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
    }

    public function deleteImage(int $product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);

        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }

        $productImage->delete();

        return redirect()->back()->with('message', 'Product image deleted');
    }

    public function delete(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if($product->images) {
            foreach ($product->images as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product deleted');
    }
}
