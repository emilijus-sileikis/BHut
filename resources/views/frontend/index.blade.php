@extends('layouts.app')

@section('content')

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000">

        <div class="carousel-inner">

            @foreach($sliders as $key => $item)

                <div class="carousel-item {{ $key == 0 ? 'active':'' }}">

                    @if($item->image)
                        <img src="{{ asset("$item->image") }}" class="d-block w-100 img-fluid" alt="Slider">
                        <div class="overlay"></div>
                    @endif

                    <div class="carousel-caption d-md-block">
                        <div class="custom-carousel-content">
                            <h1>{!! $item->title !!}</h1>
                            <p>{!! $item->description !!}</p>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

@stop

@section('categories')
    @include('frontend.categories.category.index')
@stop

@section('newProducts')
    @include('frontend.categories.products.new')
@stop
