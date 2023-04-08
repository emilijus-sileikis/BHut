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

                    @php
                        $total = 0;
                    @endphp

                    @forelse($cart as $item)
                        @if($item->product)

                            @php
                                $total += $item->product->selling_price * $item->quantity;
                            @endphp

                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">

                                            @if($item->product->images)
                                                <img
                                                    src="{{ asset($item->product->images[0]->image) }}"
                                                    class="img-fluid rounded-3" alt="Cotton T-shirt"
                                                    style="width: 100%; max-height: 150px; object-fit: contain;">
                                            @endif

                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">{{$item->product->name}}</p>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown(); handleQuantityChange({{ $item->id }})">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form{{ $item->id }}" name="quantity" value="{{ $item->quantity }}" type="number" class="form-control" min="0"
                                                   max="{{ $item->product->quantity }}" data-price="{{ $item->product->selling_price }}">

                                            <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp(); handleQuantityChange({{ $item->id }})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0" id="total{{ $item->id }}">{{ $item->product->selling_price * $item->quantity }}€</h5>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="{{ url('cart/remove/'.$item->id) }}" class="text-danger"><i
                                                    class="fas fa-trash fa-lg"></i></a>
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
                                <h3 class="float-left">Total: <span id="total">{{ $total }}€</span></h3>
                                <div class="mb-3" style="height: 1px; background: grey;"></div>
                                <a href="{{ url('/checkout') }}" class="btn btn-primary btn-lg" data-id="pay-btn">Proceed to Pay</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

    <script>
        function handleQuantityChange(itemId) {
            const input = document.getElementById(`form${itemId}`);
            const value = parseInt(input.value);
            const price = parseFloat(input.dataset.price);
            const totalElement = document.getElementById(`total${itemId}`);
            const totalPrice = document.getElementById('total');
            const allItems = document.querySelectorAll('[data-price]');

            if (!isNaN(value) && value >= 0) {
                const total = Array.from(allItems).reduce((acc, item) => {
                    const itemPrice = parseFloat(item.dataset.price);
                    const itemQuantity = parseInt(item.value);
                    return acc + (itemPrice * itemQuantity);
                }, 0);
                totalElement.textContent = (value * price).toFixed(2) + '€';
                totalPrice.textContent = total.toFixed(2) + '€';
            }
        }

        document.querySelector('a[data-id="pay-btn"]').addEventListener('click', function(event) {
            event.preventDefault();

            var quantities = [];
            var itemIds = [];

            document.querySelectorAll('input[name="quantity"]').forEach(function(element, index) {
                quantities.push(element.value);
                itemIds.push(element.getAttribute('id').substr(4));
            });

            // Send a fetch request to update the quantities
            fetch('{{ url("/cart/update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    quantities: quantities,
                    itemIds: itemIds
                })
            })
                .then(function(response) {
                    if (response.ok) {
                        window.location.href = 'checkout';
                    } else {
                        // Handle error response
                        throw new Error('Network response was not ok.');
                    }
                })
                .catch(function(error) {
                    // Handle fetch error
                    console.error('There was a problem with the fetch operation:', error);
                });
        });


    </script>

@endsection
