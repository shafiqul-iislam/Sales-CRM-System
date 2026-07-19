<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\CustomerAssignment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function create(array $data): Sale
    {
        return DB::transaction(function () use ($data) {
            $sale = Sale::create([
                'customer_id' => $data['customer_id'],
                'sale_date' => now(),
                'total_amount' => 0,
            ]);

            $totalAmount = 0;

            foreach ($data['products'] as $productId) {
                $product = Product::findOrFail($productId);
                $quantity = $data['quantities'][$productId];

                // Check stock
                if ($product->stock_quantity < $quantity) {
                    throw new \Exception("{$product->name} has only {$product->stock_quantity} items in stock.");
                }

                $subtotal = $product->price * $quantity;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                // Deduct stock
                $product->decrement('stock_quantity', $quantity);

                $totalAmount += $subtotal;
            }

            $sale->update([
                'total_amount' => $totalAmount,
            ]);

            // Increment KPI score if the customer is assigned to an employee
            $assignment = CustomerAssignment::where('customer_id', $data['customer_id'])->first();

            if ($assignment) {
                User::where('id', $assignment->employee_id)->increment('kpi_score');
            }

            // Load relations needed for the invoice email
            $sale->load('saleItems.product', 'customer');

            // Send the invoice email
            \Illuminate\Support\Facades\Mail::to($sale->customer->email)
                ->send(new \App\Mail\InvoiceMail($sale));

            return $sale;
        });
    }
}
