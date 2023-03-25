@extends('layouts.app')

@section('title')
    {{ $product->meta_title }}
@endsection

@section('meta_keyword')
    {{ $product->meta_keyword }}
@endsection

@section('meta_description')
    {{ $product->meta_description }}
@endsection

@section('content')

    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div id="success" class="alert alert-success" style="display: none;">Product added to cart successfully!</div>
            <div id="error" class="alert alert-danger" style="display: none;">Please log in to add items to the cart.</div>
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border img-fluid img-thumbnail">
                        @if($product->images)
                            <img src="{{ asset($product->images[0]->image) }}" class="w-100" alt="Img">
                        @else
                            No Image Added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                            <label class="label-stock bg-success">In Stock</label>
                        </h4>
                        <hr>
                        <p class="product-path">
                            <a href="/" style="text-decoration: none; color: black;">Home</a> / <a href="/categories/{{ $category->slug }}" style="text-decoration: none; color: black;">{{ $product->category->name }}</a> / <a href="/categories/{{ $category->slug }}/{{ $product->name }}" style="text-decoration: none; color: black;">{{ $product->name }}</a>
                        </p>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }}</span>
                            <span class="original-price">${{ $product->original_price }}</span>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span id="minus" class="btn btn1"><i class="fa fa-minus"></i></span>
                                <input id="quantityInput" type="number" value="1" class="input-quantity" min="1" max="{{ $product->quantity }}" />
                                <span id="plus" class="btn btn1"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <form id="add-to-cart-form" method="POST" action="/cart" enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="qty" value="{{ $product->quantity }}">
                                <button id="add-to-cart-btn" class="btn btn1" type="button" @if($product->quantity < 1) disabled @endif>@if($product->quantity < 1) Out Of Stock @else Add to Cart @endif</button>
                            </form>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!! $product->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const minusButton = document.getElementById('minus');
        minusButton.addEventListener('click', function() {
            let input = document.getElementById('quantityInput');
            let min = parseInt(input.getAttribute('min'));
            let value = parseInt(input.value);
            if (value > min) {
                input.value = value - 1;
            }
        });

        const plusButton = document.getElementById('plus');
        plusButton.addEventListener('click', function() {
            let input = document.getElementById('quantityInput');
            let max = parseInt(input.getAttribute('max'));
            let value = parseInt(input.value);
            if (value < max) {
                input.value = value + 1;
            }
        });

        const addToCartButton = document.getElementById('add-to-cart-btn');
        addToCartButton.addEventListener('click', function() {
            updateCartCount();
            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
            const errorMessage = document.getElementById('error');
            const successMessage = document.getElementById('success');
            if (!isLoggedIn) {
                errorMessage.style.display = 'block';

                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 3000);

                return;
            }

            const productId = {{ $product->id }};
            const qty = parseInt(document.getElementById('quantityInput').value);
            const url = '/cart';
            const token = '{{ csrf_token() }}';

            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('qty', qty);
            formData.append('_token', token);

            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(data => {
                    if (data.status === 200) {
                        successMessage.style.display = 'block';

                        setTimeout(() => {
                            successMessage.style.display = 'none';
                        }, 3000);
                    }
                })
                .catch(error => console.error(error));

            function updateCartCount() {
                fetch("{{ route('cart.count') }}")
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('cart-count').innerText = data.count;
                    })
                    .catch(error => console.error('Error fetching cart count:', error));
            }
        });
    </script>

@endsection
