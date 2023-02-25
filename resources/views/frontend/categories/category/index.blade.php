@extends('layouts.app')

@section('content')

    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Available Categories</h4>
                </div>

                @forelse($categories as $item)
                    <div class="col-6 col-md-3">
                        <div class="category-card">
                            <a href="{{ url('/categories/'.$item->slug) }}">
                                <div class="img-fluid category-card-img">
                                    <img src="{{asset($item->image)}}" class="w-100" alt="Category">
                                </div>
                                <div class="category-card-body">
                                    <h5>{{$item->name}}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <h5>No Categories Available</h5>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

@endsection
