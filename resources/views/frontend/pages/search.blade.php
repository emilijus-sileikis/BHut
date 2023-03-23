@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Search Results</h4>
                    <div class="underline mb-4"></div>
                </div>

                @forelse($searchProducts as $item)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">

                                @if($item->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out Of Stock</label>
                                @endif

                                <label class="stock bg-success" style="position: relative; float: right;">{{$item->quantity}}</label>

                                @if($item->images->count() > 0)
                                    <a href="{{ url('categories/'.$item->category->slug.'/'.$item->slug) }}">
                                        <img src="{{ asset($item->images[0]->image) }}" alt="{{ $item->name }}">
                                    </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <h5 class="product-name">
                                    <a href="{{ url('categories/'.$item->category->slug.'/'.$item->slug) }}">
                                        {{ $item->name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">{{$item->selling_price}}€</span>
                                    <span class="original-price">{{$item->original_price}}€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Products Found</h4>
                    </div>
                @endforelse

                <div>
                    {{ $searchProducts->appends(request()->input())->links() }}
                </div>

                <div class="text-center">
                    <a href="{{ url('/categories') }}" class="btn btn-primary px-3">Find More Products</a>
                </div>

            </div>
        </div>
    </div>

@endsection
