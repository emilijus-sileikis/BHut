<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutShow extends Component
{
    public $f_name, $l_name, $email, $address, $country, $city, $pincode, $cardName, $cardNum, $cardExp, $cardCVV, $payment_id = NULL;

    public function rules()
    {
        return [
            'f_name' => 'required|string|max:50',
            'l_name' => 'required|string|max:50',
            'email' => 'required|email|max:120',
            'address' => 'required|string|max:50',
            'country' => 'required',
            'city' => 'required',
            'pincode' => 'required|string|max:10',
            'cardName' => 'required|string|max:150',
            'cardNum' => 'required|string|max:16',
            'cardExp' => 'required|string|max:5',
            'cardCVV' => 'required|string|max:3',
        ];
    }

    public function placeOrder()
    {
        $cart = Cart::where('user_id', auth()->user()->getAuthIdentifier())->get();

        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'tracking_no' => 'bhut-'.Str::random(10),
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'email' => $this->email,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'status' => 'in progress',
            'country' => $this->country,
            'city' => $this->city,
            'payment_id' => $this->payment_id
        ]);

        foreach ($cart as $item) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->selling_price
            ]);
        }

        return $order;
    }

    public function cardOrder()
    {
        $cardOrder = $this->placeOrder();

        if ($cardOrder) {

            Cart::where('user_id', auth()->user()->getAuthIdentifier())->delete();

            session()->flash('message', 'Order Placed Successfully!');

            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully!',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }
    public function render()
    {
        $cart = Cart::where('user_id', auth()->user()->getAuthIdentifier())->get();
        $user = auth()->user();
        return view('livewire.frontend.checkout.checkout-show', [
            'cart' => $cart,
            'user' => $user
        ]);
    }
}
