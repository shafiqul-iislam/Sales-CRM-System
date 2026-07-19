<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Http\Requests\SaleRequest;
use App\Services\SaleService;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('customer')
            ->latest()
            ->paginate(10);

        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        $products = Product::orderBy('name')->get();

        return view('admin.sales.create', compact(
            'customers',
            'products'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request, SaleService $saleService)
    {
        try {
            $saleService->create($request->validated());

            return redirect()
                ->route('admin.sales.index')
                ->with('success', 'Sale created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load([
            'customer',
            'saleItems.product',
        ]);

        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
