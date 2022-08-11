<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function show(int $prod_id)
    {

        $product = Product::find($prod_id);
        if ($product)
            return new ProductResource($product);
        else
            return self::getNotFoundResponse();

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

        return new ProductResource($product);
    }

    public function update(Request $request, int $prod_id)
    {
        $product = Product::find($prod_id);
        if($product){
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
        }else{
            return self::getNotFoundResponse();
        }
    }

    public function destroy(int $prod_id)
    {
        $product = Product::find($prod_id);
        if($product){
            $title = $product->title;
            $product->delete();
            return response()->json([
                'status' => 202,
                'message' => "Product: $title, deleted Successfully"
            ], 202);
        } else  {
            return self::getNotFoundResponse();
        }

    }

    public static function getNotFoundResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 404,
            'message' => "Product Not Found"
        ], 404);
    }
}
