<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt.verify', 'api'])->except(['index']);
        $this->middleware(['CreatorOnly'])->only(['update', 'destroy']);
    }

    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100|unique:products,title',
            'price' => 'required|numeric',
        ]);

        $product = Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'user_id' => auth()->id(),
        ]);

        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'sometimes|required|string|min:3|max:100|unique:products,title,' . $product->id,
            'price' => 'sometimes|required|numeric',
        ]);
        if ($request->title)
            $product->title = $request->title;
        if ($request->price)
            $product->price = $request->price;

        if ($product->isDirty())
            $product->save();

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $title = $product->title;
        $product->delete();
        return response()->json([
            'status' => 200,
            'message' => "Product: $title, deleted Successfully"
        ], 202);
    }
}
