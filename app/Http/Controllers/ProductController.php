<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'size' => 'required',
        'price' => 'required|numeric',
    ]);

    $data = $request->except('_token'); // Mengabaikan atribut _token dari data yang akan disimpan

    Product::create($data);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}

public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'size' => 'required',
        'price' => 'required|numeric',
    ]);

    $data = $request->except('_token'); // Mengabaikan atribut _token dari data yang akan diperbarui

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


public function destroy($id)
{
    $product = Product::find($id);
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully.');
}
}
