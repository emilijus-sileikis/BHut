@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Product
                        <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm text-white float-right align-content-center"> Back </a>
                    </h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="main-tab" data-toggle="tab" data-target="#main-tab-pane" type="button" role="tab" aria-controls="main-tab-pane" aria-selected="true">Main</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seo-tab" data-toggle="tab" data-target="#seo-tab-pane" type="button" role="tab" aria-controls="seo-tab-pane" aria-selected="false">SEO Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="detail-tab" data-toggle="tab" data-target="#detail-tab-pane" type="button" role="tab" aria-controls="detail-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="img-tab" data-toggle="tab" data-target="#img-tab-pane" type="button" role="tab" aria-controls="img-tab-pane" aria-selected="false">Images</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade border p-3 show active" id="main-tab-pane" role="tabpanel" aria-labelledby="main-tab" tabindex="0">
                                <div class="mb-3 mt-3">
                                    <label for="cat">Category</label>
                                    <select id="cat" name="category_id" class="form-control" required>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name">Product Name</label>
                                    <input type="text" id="name" name="name" class="form-control" maxlength="50" required>
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Product Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" maxlength="100" required>
                                </div>
                                <div class="mb-3">
                                    <label for="short_descr">Short Description (200 Symbols)</label>
                                    <textarea id="short_descr" name="small_description" class="form-control" rows="4" maxlength="200" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="descr">Description</label>
                                    <textarea id="descr" name="description" class="form-control" rows="4" maxlength="500" required></textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
                                <div class="mb-3 mt-3">
                                    <label for="meta">Meta Title</label>
                                    <input type="text" id="meta" name="meta_title" class="form-control" maxlength="100" required>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_descr">Meta Description</label>
                                    <textarea id="meta_descr" name="meta_description" class="form-control" rows="4" maxlength="100" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_key">Meta Keyword</label>
                                    <textarea id="meta_key" name="meta_keyword" class="form-control" rows="4" maxlength="100" required></textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="detail-tab-pane" role="tabpanel" aria-labelledby="detail-tab" tabindex="0">
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="or_price">Original Price</label>
                                            <input type="text" id="or_price" name="original_price" class="form-control" maxlength="6" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="sell_price">Selling Price</label>
                                            <input type="text" id="sell_price" name="selling_price" class="form-control" maxlength="6" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="qnt">Quantity</label>
                                            <input type="number" id="qnt" name="quantity" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="trnd">Trending</label> <br>
                                            <input type="checkbox" id="trnd" name="trending" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="stat">Status (Checked=Hidden, Unchecked=Visible)</label> <br>
                                            <input type="checkbox" id="stat" name="status" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="img-tab-pane" role="tabpanel" aria-labelledby="img-tab" tabindex="0">
                                <div class="mb-3 mt-3">
                                    <label>Upload Images (MAX: 4MB)</label>
                                    <input type="file" name="image[]" multiple class="form-control"/>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
