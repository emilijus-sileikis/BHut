<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = Carbon::now();
        $orders = Order::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        }, function ($q) use ($todayDate){
            return $q->whereDate('created_at', $todayDate);
        })
            ->when($request->status != null, function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function view($order_id)
    {
        $order = Order::where('id', $order_id)->first();

        if ($order) {
            return view('admin.orders.view', compact('order'));
        } else {
            return redirect()->back();
        }
    }

    public function updateOrderStatus($order_id, Request $request)
    {
        $order = Order::where('id', $order_id)->first();

        if ($order) {

            $order->update([
                'status' => $request->order_status
            ]);

            return redirect('admin/orders/'.$order_id)->with('message', 'Updated');
        } else {
            return redirect('admin/orders/'.$order_id)->with('message', 'Error');
        }
    }
}
