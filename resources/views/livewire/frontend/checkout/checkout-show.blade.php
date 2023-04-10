<div>
    <div class="container">
        <h2>Checkout</h2> <br>
        <div class="row">

            @php
                $total = 0;
            @endphp

            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                </h4>
                <ul class="list-group mb-3">

                    @forelse($cart as $item)
                        @if($item->product)

                            @php
                                $total += $item->product->selling_price * $item->quantity;
                            @endphp

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $item->product->name }}</h6>
                                    <small class="text-muted">{{ $item->product->small_description }}</small>
                                </div>
                                <span class="text-muted">{{ $item->product->selling_price * $item->quantity }}€</span>
                            </li>

                        @endif
                    @empty
                        <div>No Items In The Cart</div> <br>
                    @endforelse

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total:</span>
                        <strong>{{ $total }}€</strong>
                    </li>
                </ul>

            </div>

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Customer Information</h4>
                <form class="needs-validation">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" wire:model="f_name" id="firstName" placeholder="" value="" maxlength="50" required>
                            @error('f_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" wire:model="l_name" id="lastName" placeholder="" value="" maxlength="50" required>
                            @error('l_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" wire:model="email" id="email" placeholder="you@example.com" value="{{ $user->email }}" maxlength="120" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" wire:model="address" id="address" placeholder="Street 12-34" maxlength="50" required>
                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" wire:model="country" id="country" required>
                                <option value="">Choose...</option>
                                <option>Lithuania</option>
                            </select>
                            @error('country') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="state">City</label>
                            <select class="custom-select d-block w-100" wire:model="city" id="state" required>
                                <option value="">Choose...</option>
                                <option>Vilnius</option>
                                <option>Kaunas</option>
                                <option>Klaipėda</option>
                                <option>Panevėžys</option>
                                <option>Šiauliai</option>
                            </select>
                            @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" wire:model="pincode" id="zip" placeholder="" maxlength="10" required>
                            @error('pincode') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <hr class="mb-4">

                    <div id="paypal-button-container" wire:ignore></div>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')

        <script src="https://www.paypal.com/sdk/js?client-id=ARZhdxsfxWMI1lY26csal6T4KLpQJ6byN4bSllHWEh6Pxt5_B466lwCrSl1dC84ulh7JveynrrGY5pfb&currency=EUR"></script>

        <script>
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            paypal.Buttons({

                onClick() {

                    // Show a validation error if the checkbox is not checked
                    if (!document.getElementById('firstName').value
                        || !document.getElementById('lastName').value
                        || !document.getElementById('email').value
                        || !document.getElementById('country').value
                        || !document.getElementById('state').value
                        || !document.getElementById('address').value
                        || !document.getElementById('zip').value
                    )
                    {
                         Livewire.emit('validationForAll');
                        return false;
                    } else {
                        @this.set('f_name', document.getElementById('firstName').value);
                        @this.set('l_name', document.getElementById('lastName').value);
                        @this.set('email', document.getElementById('email').value);
                        @this.set('country', document.getElementById('country').value);
                        @this.set('city', document.getElementById('state').value);
                        @this.set('address', document.getElementById('address').value);
                        @this.set('pincode', document.getElementById('zip').value);
                    }
                },

                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: {{ $total }}
                            }
                        }]
                    });
                },

                // Finalize the transaction on the server after payer approval
                onApprove(data, actions) {
                    return actions.order.capture().then(function (orderData) {
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        const transaction = orderData.purchase_units[0].payments.captures[0];

                        if (transaction.status === "COMPLETED") {
                            Livewire.emit('transactionEmit', transaction.id);
                        }
                    });
                }
            }).render('#paypal-button-container');
        </script>

    @endpush

</div>
