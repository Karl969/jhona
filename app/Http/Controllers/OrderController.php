<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\MenuItem;
use App\Models\Order;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        // Validate request
        $request->validate([
            'item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = MenuItem::find($request->item_id);
        $order = Session::get('order', []);

        if (isset($order[$item->id])) {
            $order[$item->id]['quantity'] += $request->quantity;
        } else {
            $order[$item->id] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $request->quantity,
            ];
        }

        Session::put('order', $order);
        $orderTotal = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $order));

        Session::put('order_total', $orderTotal);

        return redirect()->route('home');
    }

    public function placeOrder(Request $request)
    {
        // Get the current order
        $order = Session::get('order', []);

        if (empty($order)) {
            return redirect()->route('home')->with('error', 'No items in the order.');
        }

        // Save the order to the database
        $orderModel = new Order();
        $orderModel->total = Session::get('order_total');
        $orderModel->status = 'pending';
        $orderModel->save();

        // Clear the order from the session
        $request->session()->forget('order');
        $request->session()->forget('order_total');

        // Notify user
        return redirect()->route('home')->with('order_placed', 'Your order has been placed.');
    }

    public function cancel(Request $request)
{
    // Check if there is an order in the session
    if (Session::has('order')) {
        // Clear the entire order from the session
        $request->session()->forget('order');
        $request->session()->forget('order_total');

        // Notify the user that the order has been canceled
        return redirect()->route('home')->with('order_canceled', 'You have no orders.');
    }

    // If no order was found
    return redirect()->route('home')->with('error', 'No items to cancel.');
}
}