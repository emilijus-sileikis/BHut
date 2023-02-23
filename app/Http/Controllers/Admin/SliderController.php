<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();

        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')) {

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = rand(1000000, 9999999).'.'.$ext;
            $destinationPath = 'uploads/slider/';

            $file->move($destinationPath,$fileName);
            $validatedData['image'] = $destinationPath.$fileName;
        }

        $validatedData['status'] = $request->status ? '1':'0';

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? NULL,
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Created Successfully!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')) {

            $this->deleteImage($slider);

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = rand(1000000, 9999999).'.'.$ext;
            $destinationPath = 'uploads/slider/';
            $file->move($destinationPath,$fileName);
            $validatedData['image'] = $destinationPath.$fileName;
        }

        $validatedData['status'] = $request->status ? '1':'0';

        Slider::where('id',$slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Updated Successfully!');
    }

    public function delete(Slider $slider)
    {
        if ($slider->count() > 0) {

            $this->deleteImage($slider);

            $slider->delete();
            return redirect()->back()->with('message', 'Slider Deleted Successfully');
        }
        return redirect()->back()->with('message', 'Something went wrong');
    }

    public function deleteImage(Slider $slider)
    {
        $path = $slider->image;

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
