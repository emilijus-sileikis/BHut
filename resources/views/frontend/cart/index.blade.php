@extends('layouts.app')

@section('title', 'Cart List')

@section('content')

    <section class="h-100 bg-light">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                    </div>

                    @forelse($cart as $item)
                        @if($item->product)
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">

                                            @if($item->product->images)
                                                <img
                                                    src="{{ asset($item->product->images[0]->image) }}"
                                                    class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            @endif

                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">{{$item->product->name}}</p>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="0" name="quantity" value="{{ $item->quantity }}" type="number"
                                                   class="form-control form-control-sm" />

                                            <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0">{{ $item->product->selling_price }}€</h5>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="{{ url('cart/remove/'.$item->id) }}" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div>No Items In The Cart</div> <br>
                    @endforelse

                    @if(count($cart) > 0)
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary btn-lg">Proceed to Pay</button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
