@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Category
                        <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm text-white float-right align-content-center"> Back </a>
                    </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/category') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" maxlength="22" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slug">Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" maxlength="50" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="descr">Description</label>
                                    <textarea id="descr" name="description" class="form-control" rows="3" maxlength="200" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stat">Status (Checked=Hidden, Unchecked=Visible)</label><br/>
                                    <input type="checkbox" id="stat" name="status">
                            </div>
                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_t">Meta Title</label>
                                    <input type="text" id="meta_t" name="meta_title" class="form-control" maxlength="50" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_k">Meta Keyword</label>
                                    <textarea id="meta_k" name="meta_keyword" class="form-control" rows="3" maxlength="50" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_d">Meta Description</label>
                                    <textarea id="meta_d" name="meta_description" class="form-control" rows="3" maxlength="200" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
