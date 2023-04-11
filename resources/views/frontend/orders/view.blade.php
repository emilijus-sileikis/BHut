@extends('layouts.app')

@section('title', 'My Order View')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">
                            <i class="fa fa-shopping-cart"> My Order Details</i>
                            <a href="/orders" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Details:</h5>
                                <hr>
                                <h6>Order Id: {{ $order->id }}</h6>
                                <h6>Tracking Num: {{ $order->tracking_no }}</h6>
                                <h6>Order date: {{ $order->created_at }}</h6>
                                <h6 class="border p-2 text-success">
                                    Order Status: <span class="text-uppercase">{{ $order->status }}</span>
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <h5>User Details:</h5>
                                <hr>
                                <h6>Name: {{ $order->f_name }}</h6>
                                <h6>Lastname: {{ $order->l_name }}</h6>
                                <h6>Email: {{ $order->email }}</h6>
                                <h6>Address: {{ $order->address }}</h6>
                                <h6>ZIP: {{ $order->pincode }}</h6>
                            </div>
                        </div>

                        <br>
                        <h5>Order Items:</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                </thead>

                                <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @forelse($order->orderItems as $item)
                                    <tr>
                                        <td style="width: 10%">{{ $item->id }}</td>
                                        <td style="width: 10%">
                                            @if($item->product->images)
                                                <img src="{{ asset($item->product->images[0]->image) }}" style="width: 100px; height: 100px; object-fit: contain;" alt="">
                                            @else
                                                <img src="" style="width: 50px; height: 50px;" alt="">
                                            @endif
                                        </td>
                                        <td style="width: 10%">{{ $item->product->name }}</td>
                                        <td style="width: 10%">{{ $item->price }} €</td>
                                        <td style="width: 10%">{{ $item->quantity }}</td>
                                        <td style="width: 10%" class="fw-bold">{{ $item->quantity * $item->price }} €</td>
                                        @php
                                            $totalPrice += $item->quantity * $item->price;
                                        @endphp
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Orders Available</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="5" class="fw-bold">Total Amount:</td>
                                    <td colspan="1" class="fw-bold">{{ $totalPrice }} €</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
