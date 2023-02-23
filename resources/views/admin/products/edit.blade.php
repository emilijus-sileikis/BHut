@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
                <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit Product
                        <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm text-white float-right align-content-center"> Back </a>
                    </h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                    <select id="cat" name="category_id" class="form-control">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected':''}}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name">Product Name</label>
                                    <input type="text" id="name" name="name" value="{{ $product->name }}" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Product Slug</label>
                                    <input type="text" id="slug" name="slug" value="{{ $product->slug }}" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="short_descr">Short Description (100 Words)</label>
                                    <textarea id="short_descr" name="small_description" class="form-control" rows="4">{{ $product->small_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="descr">Description</label>
                                    <textarea id="descr" name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
                                <div class="mb-3 mt-3">
                                    <label for="meta">Meta Title</label>
                                    <input type="text" id="meta" name="meta_title" value="{{ $product->meta_title }}" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="meta_descr">Meta Description</label>
                                    <textarea id="meta_descr" name="meta_description" class="form-control" rows="4">{{ $product->meta_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_key">Meta Keyword</label>
                                    <textarea id="meta_key" name="meta_keyword" class="form-control" rows="4">{{ $product->meta_keyword }}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="detail-tab-pane" role="tabpanel" aria-labelledby="detail-tab" tabindex="0">
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="or_price">Original Price</label>
                                            <input type="text" id="or_price" name="original_price" value="{{ $product->original_price }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="sell_price">Selling Price</label>
                                            <input type="text" id="sell_price" name="selling_price" value="{{ $product->selling_price }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="qnt">Quantity</label>
                                            <input type="number" id="qnt" name="quantity" value="{{ $product->quantity }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="trnd">Trending</label> <br>
                                            <input type="checkbox" id="trnd" name="trending" value="{{ $product->trending == '1' ? 'checked':'' }}" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="stat">Status</label> <br>
                                            <input type="checkbox" id="stat" name="status" value="{{ $product->status == '1' ? 'checked':'' }}" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="img-tab-pane" role="tabpanel" aria-labelledby="img-tab" tabindex="0">
                                <div class="mb-3 mt-3">
                                    <label>Upload Images</label>
                                    <input type="file" name="image[]" multiple class="form-control"/>
                                </div>
                                <div>
                                    @if($product->images)
                                        <div class="row">
                                            @foreach($product->images as $item)
                                                <div class="col-md-2 d-flex flex-column align-items-center">
                                                    <img src="{{ asset($item->image) }}" style="width: 100px; height: 100px;" class="me-4 border" alt=""/>
                                                    <a href="{{ url('admin/product-image/'.$item->id.'/delete') }}" class="btn-sm btn-danger mt-auto" style="color: white; cursor: pointer;">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                    <h5>No Images</h5>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
