<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt.verify','api'])->except(['index']);
        $this->middleware(['CreatorOnly'])->only(['update','destroy']);
    }

    public function index()
    {
        return Product::all();
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title'=>'required|string|min:3|max:100|unique:products,title',
            'price'=>'required|numeric',
        ]);
        $fields['user_id']=auth()->id();
        $product = Product::create($fields);

        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $fields = $request->validate([
            'title'=>'required|string|min:3|max:100|unique:products,title,' . $product->id,
            'price'=>'required|numeric',
        ]);
        $product->update($fields);

        return response()->json($product, 202);
    }

    public function destroy(Product $product)
    {
        $title = $product->title;
        $product->delete();
        return response()->json(['status'=>"Product: $title, deleted Successfully"], 202);
    }
}
