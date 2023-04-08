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
                                <option>United States</option>
                            </select>
                            @error('country') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="state">City</label>
                            <select class="custom-select d-block w-100" wire:model="city" id="state" required>
                                <option value="">Choose...</option>
                                <option>California</option>
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

                    <h4 class="mb-3">Payment Information</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" wire:model="cardName" id="cc-name" placeholder="" maxlength="150" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            @error('cardName') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" wire:model="cardNum" id="cc-number" placeholder="" maxlength="16" required>
                            @error('cardNum') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" wire:model="cardExp" id="cc-expiration" placeholder="" maxlength="5" required>
                            @error('cardExp') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" wire:model="cardCVV" id="cc-cvv" placeholder="" maxlength="3" required>
                            @error('cardCVV') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div id="credit-card-btn">
                        <button type="button" wire:click="cardOrder" class="btn btn-primary btn-lg btn-block" >Continue with Credit Card</button>
                    </div>

                    <div id="paypal-btn" style="display: none;">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue with PayPal</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        const creditCardBtn = document.getElementById('credit-card-btn');
        const paypalBtn = document.getElementById('paypal-btn');
        const creditRadio = document.getElementById('credit');
        const paypalRadio = document.getElementById('paypal');

        creditRadio.addEventListener('change', function() {
            creditCardBtn.style.display = 'block';
            paypalBtn.style.display = 'none';
        });

        paypalRadio.addEventListener('change', function() {
            creditCardBtn.style.display = 'none';
            paypalBtn.style.display = 'block';
        });
    </script>

</div>
