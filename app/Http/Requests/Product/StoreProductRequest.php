<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.name' => ['required', 'string', 'max:255'],
            'data.attributes.description' => ['required', 'string'],
            'data.attributes.price' => ['required', 'numeric'],
            'data.attributes.stock' => ['required', 'integer'],
            // 'data.relationships.category.id' => ['required', 'integer'],
        ];
    }
}