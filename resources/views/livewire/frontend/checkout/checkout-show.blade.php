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
                            <input type="number" class="form-control" wire:model="pincode" id="zip" placeholder="" maxlength="10" required>
                            @error('pincode') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment Information</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Mastercard</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div>
                    </div>

                    <div id="card-info">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" wire:model="cardName" id="cc-name" placeholder="Name Lastname" maxlength="150" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                @error('cardName') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" wire:model="cardNum" id="cc-number" placeholder="1234-1234-1234-1234" maxlength="19" required>
                                @error('cardNum') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" wire:model="cardExp" id="cc-expiration" placeholder="MM/YY" maxlength="5" required>
                                @error('cardExp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" wire:model="cardCVV" id="cc-cvv" placeholder="123" maxlength="3" required>
                                @error('cardCVV') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div id="credit-card-btn">
                        <button type="button" wire:click="cardOrder" class="btn btn-primary btn-lg btn-block" >Continue with Mastercard Card</button>
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
        const cardPart = document.getElementById('card-info');

        creditRadio.addEventListener('change', function() {
            creditCardBtn.style.display = 'block';
            cardPart.style.display = 'block';
            paypalBtn.style.display = 'none';
        });

        paypalRadio.addEventListener('change', function() {
            creditCardBtn.style.display = 'none';
            cardPart.style.display = 'none';
            paypalBtn.style.display = 'block';
        });

        var cardNumberInput = document.getElementById('cc-number');

        cardNumberInput.addEventListener('input', function(e) {
            var value = e.target.value;

            // Remove non-numeric characters
            value = value.replace(/\D/g, '');

            // Add dashes every 4 characters, unless it's the end of the input
            var formattedValue = '';
            for (var i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0 && i < value.length - 1) {
                    formattedValue += '-';
                }
                formattedValue += value[i];
            }

            e.target.value = formattedValue;
        });

        const expDateInput = document.getElementById('cc-expiration');

        expDateInput.addEventListener('input', function(event) {
            const value = event.target.value.replace(/\D/g, '');
            const month = value.slice(0, 2);
            const year = value.slice(2, 4);
            const separator = value.length > 2 ? '/' : '';
            event.target.value = `${month}${separator}${year}`;
        });

        const cvvInput = document.getElementById('cc-cvv');

        cvvInput.addEventListener('input', function(event) {
            // Remove all non-digit characters
            var cvv = cvvInput.value.replace(/\D/g, '');

            // Trim any extra spaces at the end
            cvv = cvv.trim();

            // Update the input field value
            event.target.value = cvv;
        });


    </script>

</div>
