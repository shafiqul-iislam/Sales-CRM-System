<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display products for third-party e-commerce platforms.
     */
    public function __invoke()
    {
        $products = Product::select(
            'id',
            'sku',
            'name',
            'price',
            'stock_quantity'
        )->where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();

        return ProductResource::collection($products);
    }
}
