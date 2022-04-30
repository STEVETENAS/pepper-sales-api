<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\IndexFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    { return response()->json(ProductResource::collection(Product::all()),206); }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $product = Product::query()->create($request->validated());
        if (!$product)
        { return response()->json( $product,400); }

        if($request->hasFile('image') && $request->file('image')?->isValid())
        { $product->addMediaFromRequest('image')->toMediaCollection('Product-images'); }
        return response()->json( ProductResource::make($product),201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::query()->find($id);
        if(! $product) { return response()->json($product,404); }
        return response()->json(ProductResource::make($product),206);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, int $id): JsonResponse
    {
        $product = Product::query()->find($id);
        if(! $product) { return response()->json($product,404); }

        if (! $product->update($request->validated()))
        { return response()->json($product,400); }

        if ($request->hasFile('image')) {
            $product->clearMediaCollection('Product-images');
            $product->addMediaFromRequest('image')->toMediaCollection('Product-images');
        }

        return response()->json(ProductResource::make($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $product = Product::query()->find($id);
        if(! $product) { return response()->json($product,404); }

        if (! $product->delete())
        { return response()->json($product,400); }
        return response()->json(ProductResource::make($product),204);
    }
}
