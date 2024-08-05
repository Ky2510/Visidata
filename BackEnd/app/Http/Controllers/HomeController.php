<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function index() 
    {
        return view('home', [
            'transaksi' => TransactionModel::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function item() 
    {
       return view('item', [
         'items' => ItemModel::all()
       ]);
    }

    public function itemStore(Request $request)
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
        
            return redirect()->route('home.index');
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->errors(),
            ], 422);
        }
    }
}
