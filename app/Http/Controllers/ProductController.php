<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Validator;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index(Request $request){
        $product = Product::all();
        return $product;
    }

    public function create(Request $request){
        
            $validator = Validator::make($request-> all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'amount'=> 'required|int'
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors());
            }

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'amount' => $request->amount,
            ]);

            return response()->json(['data' => $product ]);
      
    }


    public function show($id){
        $product = Product::findOrFail($id);
            
        return response()->json(['data' => $product ]);
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount'=> 'required|int'
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->amount = $request->input('amount');
        $product->save();

        return response()->json(['message' => 'Producto actualizado correctamente.']);
    }

    public function destroy($id)
    {
        // Retrieve the product from the database
        $product = Product::findOrFail($id);
        // Delete the product from the database
        $product->delete();
        // Return a success response
        return response()->json(['message' => 'Producto Eliminado correctamente.']);    
    }
}
