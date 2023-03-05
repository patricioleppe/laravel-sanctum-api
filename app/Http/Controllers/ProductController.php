<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Validator;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        
        $product = Product::all();
        return $product;
    
    }


    public function create(Request $request)
    {
        
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
            
        return response()->json(['data' => $product ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount'=> 'required|int'
        ]);

        // Update the user's information
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->amount = $request->input('amount');
        $product->save();

        // Return a success response
        return response()->json(['message' => 'Producto actualizado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
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
