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
                                <div class="category-card-img">
                                    <img src="{{asset($item->image)}}" class="image-fit" alt="Category">
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

{{--                <div class="test">--}}
{{--                    <div class="content">--}}
{{--                        <h1>Responsive image with picturefill and object-fit</h1>--}}
{{--                        <div class="image">--}}
{{--                            <img class="image-fit" alt="Sunflower" srcset="https://skywalkapps.github.io/assets/images/sunflower-320.jpg 320w, https://skywalkapps.github.io/assets/images/sunflower-650.jpg 650w, https://skywalkapps.github.io/assets/images/sunflower-1300.jpg 1300w" sizes="(min-width: 650px) 650px, 100vw">--}}
{{--                            <noscript>--}}
{{--                                <img class="image-fit" alt="Sunflower" src="https://skywalkapps.github.io/assets/images/sunflower-320.jpg">--}}
{{--                            </noscript>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
    </div>

@endsection
