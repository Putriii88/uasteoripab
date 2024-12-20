<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json([
            'message' => 'Transaction created successfully!',
            'data' => $transaction,
        ], 201);
    }
}
