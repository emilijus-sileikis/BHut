@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category
                        <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm text-white float-right align-content-center"> Back </a>
                    </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/category/'.$item->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="{{ $item->name }}" class="form-control" maxlength="22" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slug">Slug</label>
                                    <input type="text" id="slug" name="slug" value="{{ $item->slug }}" class="form-control" maxlength="50" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="descr">Description</label>
                                    <textarea id="descr" name="description" class="form-control" rows="3" maxlength="200" required>{{ $item->description }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                    <img src="{{ asset($item->image) }}" width="60px" height="60px">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stat">Status (Checked=Hidden, Unchecked=Visible)</label> <br>
                                <input id="stat" type="checkbox" name="status" {{ $item->status == '1' ? 'checked':'' }} style="width: 20px; height: 20px;">
                            </div>
                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_t">Meta Title</label>
                                    <input type="text" id="meta_t" name="meta_title" value="{{ $item->meta_title }}" class="form-control" maxlength="50" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_k">Meta Keyword</label>
                                    <textarea id="meta_k" name="meta_keyword" class="form-control" rows="3" maxlength="50" required>{{ $item->meta_keyword }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_d">Meta Description</label>
                                    <textarea id="meta_d" name="meta_description" class="form-control" rows="3" maxlength="200" required>{{ $item->meta_description }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
