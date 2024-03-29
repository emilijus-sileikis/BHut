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
            <div id="success2" class="alert alert-success" style="display: none;">Product added to wishlist successfully!</div>
            <div id="error" class="alert alert-danger" style="display: none;">Please log in to add items to the cart.</div>
            <div id="error2" class="alert alert-danger" style="display: none;">Please log in to add items to the wishlist.</div>
            <div id="inWishlist" class="alert alert-danger" style="display: none;">Item already in wishlist!</div>
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border img-fluid img-thumbnail">
                        @if($product->images)
                            <img src="{{ asset($product->images[0]->image) }}" class="w-100" alt="Img" style="max-height: 500px; max-width: 100%; object-fit: contain;">
                        @else
                            No Image Added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                            <label class="label-stock bg-success" id="inStock">In Stock</label>
                            <label class="label-stock bg-danger" id="outOfStock" style="display: none;">Out Of Stock</label>

                        </h4>
                        <hr>
                        <p class="product-path">
                            <a href="/" style="text-decoration: none; color: black;">Home</a> / <a href="/categories/{{ $category->slug }}" style="text-decoration: none; color: black;">{{ $product->category->name }}</a> / <a href="/categories/{{ $category->slug }}/{{ $product->name }}" style="text-decoration: none; color: black;">{{ $product->name }}</a>
                        </p>
                        <div>
                            <span class="selling-price">{{ $product->selling_price }}€</span>
                            <span class="original-price">{{ $product->original_price }}€</span>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1">
                                    <a href="{{ url('like/'.$product->id) }}" style="text-decoration: none; color: black;" class="like-btn {{ $product->likes()->where('user_id', Auth::id())->where('like', 1)->exists() ? 'text-success' : '' }}">
                                        <i class="fa fa-thumbs-up"></i>
                                        <span class="like-count">{{ $product->likes()->where('like', 1)->count() }}</span>
                                    </a>
                                </span>

                                <span class="btn btn1">
                                    <a href="{{ url('dislike/'.$product->id) }}" style="text-decoration: none; color: black;" class="dislike-btn {{ $product->likes()->where('user_id', Auth::id())->where('dislike', 1)->exists() ? 'text-danger' : '' }}">
                                        <i class="fa fa-thumbs-down"></i>
                                        <span class="dislike-count">{{ $product->likes()->where('dislike', 1)->count() }}</span>
                                    </a>
                                </span>
                            </div>
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
                                <button id="add-to-cart-btn" class="btn btn1" type="button">Add to Cart</button>
                            </form>

                            <form id="add-to-wishlist-form" method="POST" action="/wishlist" enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button id="add-to-wishlist-btn" class="btn btn1" type="button"> <i class="fa fa-heart"></i> Add To Wishlist </button>
                            </form>
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
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                            <div class="card-header">
                                <h4>Comments</h4>
                            </div>
                            <form action="{{ route('comment', $product->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name="content" class="form-control" placeholder="Leave a comment" maxlength="255" required></textarea>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <hr>
                        @foreach($product->comments as $comment)
                            <div class="mb-2" style="margin-left: 5px;">
                                @if(Auth::id() == $comment->user_id)
                                    <form method="POST" action="{{ route('delete_comment', $comment->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm float-end" style="margin-right: 5px;"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                                <strong>{{ $comment->user->name }}</strong>
                                <p>{{ $comment->content }}</p>
                                <small class="text-muted">{{ $comment->created_at->format('F j, Y g:i a') }}</small>
                            </div>
                            <div style="border: solid lightgray 1px; margin-bottom: 10px;"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            updateProductQuantity(<?php echo $product->quantity; ?>);
        };

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
                .then(response => response.json())
                .then(data => {
                    if (data.count !== undefined) {
                        updateCartCount();
                        updateProductQuantity(data.qty);
                        successMessage.style.display = 'block';

                        setTimeout(() => {
                            successMessage.style.display = 'none';
                        }, 3000);
                    } else if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        errorMessage.style.display = 'block';

                        setTimeout(() => {
                            errorMessage.style.display = 'none';
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

        function updateProductQuantity(qty) {
            const qtyEl = document.getElementById('quantityInput');
            const inStock = document.getElementById('inStock');
            const outStock = document.getElementById('outOfStock');
            const cartBtn = document.getElementById('add-to-cart-btn');

            qtyEl.value = '1';

            if (qty > 0) {
                qtyEl.max = qty;
            } else {
                qtyEl.max = '1';
                inStock.style.display = 'none';
                outStock.style.display = 'block';

                cartBtn.disabled = true;
                cartBtn.innerText = 'Out Of Stock';
            }

        }

        const addToWishlistButton = document.getElementById('add-to-wishlist-btn');
        addToWishlistButton.addEventListener('click', function() {
            updateWishlistCount();
            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
            const errorMessage = document.getElementById('error2');
            const successMessage = document.getElementById('success2');
            const alreadyPresent = document.getElementById('inWishlist');
            if (!isLoggedIn) {
                errorMessage.style.display = 'block';

                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 3000);

                return;
            }

            const productId = {{ $product->id }};
            const url = '/wishlist';
            const token = '{{ csrf_token() }}';

            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('_token', token);

            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.count !== undefined) {
                        updateWishlistCount();
                        successMessage.style.display = 'block';

                        setTimeout(() => {
                            successMessage.style.display = 'none';
                        }, 3000);
                    } else if (data.redirect) {
                        window.location.href = data.redirect;
                    } else if (data.error) {
                        alreadyPresent.style.display = 'block';

                        setTimeout(() => {
                            alreadyPresent.style.display = 'none';
                        }, 3000);
                    } else {
                        errorMessage.style.display = 'block';

                        setTimeout(() => {
                            errorMessage.style.display = 'none';
                        }, 3000);
                    }
                })
                .catch(error => console.error(error));

            function updateWishlistCount() {
                fetch("{{ route('wishlist.count') }}")
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('wishlist-count').innerText = data.count;
                    })
                    .catch(error => console.error('Error fetching wishlist count:', error));
            }
        });
    </script>

@endsection
