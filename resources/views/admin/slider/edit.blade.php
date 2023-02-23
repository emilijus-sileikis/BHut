@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Slider
                        <a href="{{ url('admin/sliders') }}" class="btn btn-primary btn-sm text-white float-right align-content-center"> Back </a>
                    </h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('admin/sliders/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" value="{{ $slider->title }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="descr">Description</label>
                            <textarea id="descr" name="description" class="form-control" rows="3">{{ $slider->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img">Image</label>
                            <input id="img" type="file" name="image" class="form-control">
                            <img src="{{ asset("$slider->image") }}" class="img-fluid img-thumbnail" style="height: 120px; width: 300px; border-radius: 0.25rem; text-align: center;" alt="Slider">
                        </div>
                        <div class="mb-3">
                            <label for="stat">Status (Checked=Hidden, Unchecked=Visible)</label> <br>
                            <input id="stat" type="checkbox" name="status" {{ $slider->status == '1' ? 'checked':'' }} style="width: 20px; height: 20px;">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
