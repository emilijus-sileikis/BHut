@extends('layouts.app')

@section('content')

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

        <div class="carousel-inner">

            @foreach($sliders as $key => $item)

                <div class="carousel-item {{ $key == 0 ? 'active':'' }}">

                    @if($item->image)
                        <img src="{{ asset("$item->image") }}" class="d-block w-100" alt="...">
                    @endif

                    <div class="carousel-caption d-none d-md-block">
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

@endsection
