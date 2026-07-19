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
    public function toArray($request): array
    {
        return [
            'sku' => $this->sku,
            'product_name' => $this->name,
            'price' => $this->price,
            'available_stock' => $this->stock_quantity,
        ];
    }
}
