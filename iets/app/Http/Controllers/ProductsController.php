<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id = null)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',            
            'price' => 'required|decimal:2',
            'stock' => 'required|numeric',
            'description' => 'nullable',
        ]);
    
        if (intval($id) > 0) {
            // Find the product by ID
            $product = Products::findOrFail($id);
            $product->update($validate);
            $message = 'Product updated successfully.';
        } else {
            // Create new product
            $validate['user_id'] = auth()->id();

            Products::create($validate);
            $message = 'Product created successfully.';
        }
    
        // Redirect back to the product list
        return redirect(route('products.index'))->with('success', 'Product updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        $product = Products::find($products->id);
        //$product = Products::where('id' , '=' , $products->id )->get();
        return view('products.edit', ['products' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        $products -> delete();
        return redirect(route('products.index'))->with('success', 'Product deleted successfully.');
    }
}
