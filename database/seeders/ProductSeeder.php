<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Wireless Mouse',         'sku' => 'PRD001', 'price' => 1200.00, 'stock_quantity' => 50],
            ['name' => 'Mechanical Keyboard',    'sku' => 'PRD002', 'price' => 4500.00, 'stock_quantity' => 30],
            ['name' => '27-inch Monitor',        'sku' => 'PRD003', 'price' => 24500.00, 'stock_quantity' => 15],
            ['name' => 'Laptop Stand',           'sku' => 'PRD004', 'price' => 1800.00, 'stock_quantity' => 40],
            ['name' => 'USB-C Hub',              'sku' => 'PRD005', 'price' => 2200.00, 'stock_quantity' => 35],
            ['name' => 'External SSD 1TB',       'sku' => 'PRD006', 'price' => 9800.00, 'stock_quantity' => 20],
            ['name' => 'Bluetooth Speaker',      'sku' => 'PRD007', 'price' => 3500.00, 'stock_quantity' => 25],
            ['name' => 'Gaming Headset',         'sku' => 'PRD008', 'price' => 4200.00, 'stock_quantity' => 18],
            ['name' => 'Webcam HD',              'sku' => 'PRD009', 'price' => 2800.00, 'stock_quantity' => 22],
            ['name' => 'Portable Hard Drive',    'sku' => 'PRD010', 'price' => 7200.00, 'stock_quantity' => 16],
            ['name' => 'Power Bank 20000mAh',    'sku' => 'PRD011', 'price' => 2600.00, 'stock_quantity' => 28],
            ['name' => 'Wireless Charger',       'sku' => 'PRD012', 'price' => 1700.00, 'stock_quantity' => 45],
            ['name' => 'USB Flash Drive 64GB',   'sku' => 'PRD013', 'price' => 900.00,  'stock_quantity' => 60],
            ['name' => 'Office Chair',           'sku' => 'PRD014', 'price' => 12500.00, 'stock_quantity' => 10],
            ['name' => 'Desk Lamp LED',          'sku' => 'PRD015', 'price' => 1500.00, 'stock_quantity' => 32],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
