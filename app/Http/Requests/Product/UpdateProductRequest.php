<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'data.attributes.name' => ['sometimes', 'string', 'max:255'],
            'data.attributes.description' => ['sometimes', 'string'],
            'data.attributes.price' => ['sometimes', 'numeric'],
            'data.attributes.stock' => ['sometimes', 'integer'],
            'data.relationships.category.data.id' => ['sometimes', 'integer'],
        ];
    }
}
