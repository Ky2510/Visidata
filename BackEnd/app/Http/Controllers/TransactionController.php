<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = TransactionModel::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'data' => $transaction,
            'message' => "fetch transaction successful",
        ]);
    }

    public function store(Request $request)
    {
        
        try {
            $validateData = $request->validate([
                'item_id' => 'required',
                'quantity' => 'required',
            ],[
                'item_id.required' => 'Barang tidak boleh kosong.',
                'quantity.required' => 'Kuantiti tidak boleh kosong.',
            ]);

            $item = ItemModel::find($validateData['item_id']);
            
            $transaction = new TransactionModel();
            $transaction->item_id = $validateData['item_id'];
            $transaction->quantity = $validateData['quantity'];
            $transaction->total = $validateData['quantity'] * $item->price;
            $transaction->status = 'paid';
            $transaction->user_id = auth()->user()->id;
            $transaction->save();
        
            return response()->json([
                'data' => $item,
                'message' => "add item successful"
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->errors(),
            ], 422);
        }
    }
}
