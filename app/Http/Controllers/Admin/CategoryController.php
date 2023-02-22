<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        //Validation is in CategoryFormRequest class

        $validatedData = $request->validated();

        $category = new Category;

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if($request->hasFile('image')) {

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = rand(1000000, 9999999).'.'.$ext;
            $destinationPath = public_path().'/uploads/category/';

            $file->move($destinationPath,$fileName);
            $category->image = $fileName;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];
        $category->status = $request->status ? '1':'0';

        $category->save();

        return redirect('admin/category')->with('message', 'Category Added Successfully!');
    }

    public function edit(Category $item)
    {
        return view('admin.category.edit', compact('item'));
    }

    public function update(CategoryFormRequest $request, Category $item)
    {
        $validatedData = $request->validated();

        $item = Category::findOrFail($item->id);

        $item->name = $validatedData['name'];
        $item->slug = Str::slug($validatedData['slug']);
        $item->description = $validatedData['description'];

        if($request->hasFile('image')) {

            $path = 'uploads/category'.$item->image;

            //TODO Not working
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = rand(1000000, 9999999).'.'.$ext;
            $destinationPath = public_path().'/uploads/category/';

            $file->move($destinationPath,$fileName);
            $item->image = $fileName;
        }

        $item->meta_title = $validatedData['meta_title'];
        $item->meta_keyword = $validatedData['meta_keyword'];
        $item->meta_description = $validatedData['meta_description'];
        $item->status = $request->status ? '1':'0';

        $item->update();

        return redirect('admin/category')->with('message', 'Category Updated Successfully!');
    }
}
