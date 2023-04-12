@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')

    <section class="h-100 bg-light">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">My Wishlist</h3>
                    </div>

                    @forelse($list as $item)
                        @if($item->product)

                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">

                                            @if($item->product->images)
                                                <a href="{{ url('categories/'.$item->product->category->slug.'/'.$item->product->slug) }}">
                                                    <img
                                                        src="{{ asset($item->product->images[0]->image) }}"
                                                        class="img-fluid rounded-3" alt="Cotton T-shirt"
                                                        style="width: 100%; max-height: 150px; object-fit: contain;">
                                                </a>
                                            @endif

                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <a href="{{ url('categories/'.$item->product->category->slug.'/'.$item->product->slug) }}" style="text-decoration: none; color: black;">
                                                <p class="lead fw-normal mb-2">{{$item->product->name}}</p>
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0" id="total{{ $item->id }}">{{ $item->product->selling_price }}€</h5>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            @if($item->product->quantity > 0)
                                                <label class="label-stock bg-success text-white p-1" style="border-radius: 5px;" id="inStock">In Stock</label>
                                            @else
                                                <label class="label-stock bg-danger text-white p-1" id="outOfStock" style="border-radius: 5px;">Out Of Stock</label>
                                            @endif
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="{{ url('wishlist/remove/'.$item->id) }}" class="text-danger"><i
                                                    class="fas fa-trash fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div>No Items In Your Wishlist</div> <br>
                    @endforelse

                </div>
            </div>
        </div>
    </section>

@endsection
