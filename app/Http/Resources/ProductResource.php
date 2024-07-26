<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'product',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->when($request->routeIs('products.show'), $this->description),
                'price' => $this->price,
                'stock' => $this->stock,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'relationships' =>
                [
                    'category' =>
                    CategoryResource::collection($this->whenLoaded('categories'))]
        ];
    }
}