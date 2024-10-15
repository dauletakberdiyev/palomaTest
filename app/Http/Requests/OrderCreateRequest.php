<?php

namespace App\Http\Requests;

use App\Http\DTO\CreateOrderDTO;
use App\Models\Place;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

final class OrderCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'place_id' => ['required', 'integer', new Exists(Place::class, 'id')],
            'products' => ['required', 'array'],
            'products.*.product_id' => ['required', 'integer', new Exists(Product::class, 'id')],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function getDTO(): CreateOrderDTO
    {
        return new CreateOrderDTO(
            (int) $this->validated('place_id'),
            $this->validated('products')
        );
    }
}
