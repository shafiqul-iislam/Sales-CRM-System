@extends('layouts.admin')

@section('title', 'Record Sale - Sales CRM')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.sales.index') }}"
                class="p-2 text-slate-400 hover:text-slate-700 hover:bg-white hover:shadow-sm rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Record New Sale</h1>
                <p class="text-slate-500 mt-1">Select a customer and add products to create a sale record.</p>
            </div>
        </div>

        <form action="{{ route('admin.sales.store') }}" method="POST" class="space-y-6" id="saleForm">
            @csrf

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 space-y-8">

                    <!-- Customer Selection -->
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Customer Details</h2>
                        <div class="max-w-md">
                            <label for="customer_id" class="block text-sm font-medium text-slate-700 mb-1.5">Select Customer</label>
                            <select name="customer_id" id="customer_id"
                                class="w-full px-4 py-2.5 bg-slate-50 border @error('customer_id') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm appearance-none"
                                required>
                                <option value="">-- Choose a customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500 relative -mt-9 ml-auto w-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            @error('customer_id')
                                <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Products List -->
                    <div>
                        <div class="flex justify-between items-end mb-4 border-b border-slate-100 pb-2">
                            <h2 class="text-lg font-bold text-slate-900">Products</h2>
                            <p class="text-sm font-medium text-slate-500">Select items to add to the invoice</p>
                        </div>
                        
                        @error('products')
                            <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg text-sm font-medium">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="overflow-x-auto border border-slate-200 rounded-xl">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200 text-sm font-semibold text-slate-600">
                                        <th class="px-4 py-3 w-12 text-center">Include</th>
                                        <th class="px-4 py-3">Product Name</th>
                                        <th class="px-4 py-3 text-right">Price</th>
                                        <th class="px-4 py-3 text-right">Stock</th>
                                        <th class="px-4 py-3 w-32">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @foreach ($products as $product)
                                        <tr class="hover:bg-slate-50 transition-colors {{ old('products') && in_array($product->id, old('products')) ? 'bg-blue-50/50' : '' }}" id="row-{{ $product->id }}">
                                            <td class="px-4 py-3 text-center">
                                                <input type="checkbox" name="products[]" value="{{ $product->id }}" 
                                                    id="product-{{ $product->id }}"
                                                    class="product-checkbox w-4 h-4 text-blue-600 bg-slate-100 border-slate-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer"
                                                    data-price="{{ $product->price }}"
                                                    data-id="{{ $product->id }}"
                                                    {{ old('products') && in_array($product->id, old('products')) ? 'checked' : '' }}>
                                            </td>
                                            <td class="px-4 py-3 font-medium text-slate-900">
                                                <label for="product-{{ $product->id }}" class="cursor-pointer block">{{ $product->name }}</label>
                                            </td>
                                            <td class="px-4 py-3 text-right text-slate-600">
                                                ${{ number_format($product->price, 2) }}
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $product->stock_quantity > 10 ? 'bg-emerald-100 text-emerald-800' : ($product->stock_quantity > 0 ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">
                                                    {{ $product->stock_quantity }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <input type="number" name="quantities[{{ $product->id }}]" id="qty-{{ $product->id }}"
                                                    min="1" max="{{ $product->stock_quantity }}" 
                                                    value="{{ old("quantities.{$product->id}", 1) }}"
                                                    class="qty-input w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-200 focus:ring-2 transition-all outline-none disabled:bg-slate-100 disabled:text-slate-400 text-right"
                                                    {{ !(old('products') && in_array($product->id, old('products'))) ? 'disabled' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- Footer / Summary -->
                <div class="bg-slate-50 px-6 py-5 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="text-slate-500 font-medium">Estimated Total:</span>
                        <span class="text-2xl font-bold text-slate-900" id="totalAmount">$0.00</span>
                    </div>
                    
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <a href="{{ route('admin.sales.index') }}"
                            class="px-5 py-2.5 w-full sm:w-auto text-center text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:border-slate-300 rounded-xl transition-colors shadow-sm">
                            Cancel
                        </a>
                        <button type="submit" id="submitBtn" disabled
                            class="px-5 py-2.5 w-full sm:w-auto text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm shadow-blue-200 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Complete Sale
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            const qtyInputs = document.querySelectorAll('.qty-input');
            const totalDisplay = document.getElementById('totalAmount');
            const submitBtn = document.getElementById('submitBtn');

            function calculateTotal() {
                let total = 0;
                let hasSelection = false;

                checkboxes.forEach(checkbox => {
                    const id = checkbox.dataset.id;
                    const price = parseFloat(checkbox.dataset.price);
                    const qtyInput = document.getElementById('qty-' + id);
                    const row = document.getElementById('row-' + id);

                    if (checkbox.checked) {
                        hasSelection = true;
                        qtyInput.disabled = false;
                        row.classList.add('bg-blue-50/50');
                        
                        const qty = parseInt(qtyInput.value) || 0;
                        total += price * qty;
                    } else {
                        qtyInput.disabled = true;
                        row.classList.remove('bg-blue-50/50');
                    }
                });

                totalDisplay.textContent = '$' + total.toFixed(2);
                submitBtn.disabled = !hasSelection;
            }

            // Listen for changes
            checkboxes.forEach(cb => cb.addEventListener('change', calculateTotal));
            qtyInputs.forEach(input => input.addEventListener('input', calculateTotal));

            // Initial calculation (in case of validation errors reloading the page with old input)
            calculateTotal();
        });
    </script>
@endsection
