<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($validated);

        return response()->json(['message' => 'Product created', 'product' => $product], 201);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',

        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return response()->json(['message' => 'Product updated', 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
    public function updateStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'stock' => 'required|integer|min:0', // Stok tidak boleh negatif
        ]);

        $product = Product::find($request->product_id);
        $product->stock = $request->stock;
        $product->save();

        return response()->json([
            'message' => 'Stock updated successfully!',
            'product_id' => $product->id,
            'stock' => $product->stock,
        ], 200);
    }
    public function checkStock($id)
    {
        $product = Product::findOrFail($id);

        return response()->json(['stock' => $product->stock], 200);
    }
}
