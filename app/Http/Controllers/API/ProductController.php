<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::with('categories')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $category = Category::findOrFail($request->input('data.relationships.category.0.id'));
        } catch (ModelNotFoundException $e) {
            return $this->ok('The category is invalid.', ['errors' => ['category' => 'The category id does not exist.']]);
        }

        $model = [
            'name' => $request->input('data.attributes.name'),
            'description' => $request->input('data.attributes.description'),
            'price' => $request->input('data.attributes.price'),
            'stock' => $request->input('data.attributes.stock'),
        ];

        $product = Product::create($model);
        $product->categories()->attach($category);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $categoryId = $request->input('data.relationships.category.0.id');
        if ($categoryId) {
            try {
                $category = Category::findOrFail($categoryId);
            } catch (ModelNotFoundException $e) {
                return $this->ok('The category is invalid.', ['errors' => ['category' => 'The category id does not exist.']]);
            }
            $product->categories()->sync([$category->id]);
        }

        $model = [];

        $attributes = $request->input('data.attributes');

        $allowedAttributes = ['name', 'description', 'price', 'stock'];

        foreach ($allowedAttributes as $attribute) {
            if (isset($attributes[$attribute])) {
                $model[$attribute] = $attributes[$attribute];
            }
        }
        $product->update($model);

        return new ProductResource($product->load('categories'));
    }

    public function destroy(Product $product)
    {
        try {
            $product = Product::findOrFail($product->id);
            $product->delete();

            return $this->ok('Product successfully deleted');
        } catch (ModelNotFoundException $exception) {
            return $this->error('Product cannot found.', 404);
        }
    }
}