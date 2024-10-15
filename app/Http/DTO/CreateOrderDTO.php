<?php

namespace App\Http\DTO;

final readonly class CreateOrderDTO
{
    public function __construct(
        public int $placeId,
        public array $products,
    ) {
    }
}
