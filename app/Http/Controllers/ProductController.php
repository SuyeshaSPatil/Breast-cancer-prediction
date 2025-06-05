<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    
public function index()
{
    $products = Product::whereNull('deleted_at')->get();
    return view('products.index', compact('products'));
}

public function create()
{
    return view('products.create');
}

public function store(Request $request)
{
    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'rate_type' =>'required|string|max:255',
        'price' => 'required|numeric',
    ]);

    // Create product
    Product::create($request->only('name', 'type', 'price'));

    // Redirect or show success
    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}


public function show(Product $product)
{
    return view('products.show', compact('product'));
}

public function edit(Product $product)
{
    return view('products.edit', compact('product'));
}

public function update(Request $request, Product $product)
{
    $product->update($request->all());
    return redirect()->route('products.index')->with('success', 'Product updated successfully');
}

public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Product deleted successfully');
}
}
