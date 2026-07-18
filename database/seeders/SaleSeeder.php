<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        foreach ($customers as $index => $customer) {

            // First 5 customers are "lost" (last purchase over 90 days ago)
            $saleDate = $index < 5 ? now()->subDays(rand(100, 180)) : now()->subDays(rand(1, 60));

            $products = Product::inRandomOrder()->take(rand(1, 3))->get();

            $totalAmount = 0;

            $sale = Sale::create([
                'customer_id' => $customer->id,
                'total_amount' => 0,
                'sale_date' => $saleDate,
            ]);

            foreach ($products as $product) {

                $quantity = rand(1, 3);
                $subtotal = $product->price * $quantity;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $totalAmount += $subtotal;
            }

            $sale->update([
                'total_amount' => $totalAmount,
            ]);
        }
    }
}
