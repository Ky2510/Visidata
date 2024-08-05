<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    public function index() 
    {
        $item = ItemModel::all();
        return response()->json([
            'data' => $item,
            'message' => "fetch barang successful",
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|unique:items',
                'price' => 'required',
            ],[
                'name.required' => 'Nama barang tidak boleh kosong.',
                'name.unique' => 'Nama barang sudah ada.',
                'price.required' => 'Harga barang tidak boleh kosong.'
            ]);
        
            $item = new ItemModel();
            $item->name = $validateData['name'];
            $item->price = $validateData['price'];
            $item->user_id = auth()->user()->id;
            $item->save();
        
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
