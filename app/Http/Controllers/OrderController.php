<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return response()->json(['error' => 'Insufficient stock'], 400);
        }

        $totalPrice = $product->price * $validated['quantity'];

        $order = Order::create([
            'user_id' => $request->user()->id,
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'total_price' => $totalPrice,
        ]);

        $product->decrement('stock', $validated['quantity']);

        return response()->json(['message' => 'Order placed', 'order' => $order], 201);
    }

    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->get();
        return response()->json($orders);
    }
}
