@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Slider
                        <a href="{{ url('admin/sliders') }}" class="btn btn-primary btn-sm text-white float-right align-content-center"> Back </a>
                    </h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('admin/sliders/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="descr">Description</label>
                            <textarea id="descr" name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img">Image (MAX: 4MB)</label>
                            <input id="img" type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="stat">Status (Checked=Hidden, Unchecked=Visible)</label> <br>
                            <input id="stat" type="checkbox" name="status" style="width: 20px; height: 20px;">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
