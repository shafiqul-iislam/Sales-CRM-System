@extends('layouts.admin')

@section('title', 'Invoice #' . str_pad($sale->id, 5, '0', STR_PAD_LEFT) . ' - Sales CRM')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.sales.index') }}"
                    class="p-2 text-slate-400 hover:text-slate-700 hover:bg-white hover:shadow-sm rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Invoice #{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}
                    </h1>
                    <p class="text-slate-500 mt-1">Generated on {{ $sale->sale_date->format('M d, Y g:i A') }}</p>
                </div>
            </div>
            <button onclick="window.print()"
                class="px-5 py-2.5 bg-white text-slate-700 font-medium rounded-xl border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-all flex items-center gap-2 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Print Invoice
            </button>
        </div>

        <div
            class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden print:shadow-none print:border-none">

            <div class="p-8 md:p-12">
                <!-- Invoice Header Info -->
                <div class="flex flex-col sm:flex-row justify-between gap-8 mb-12">
                    <div>
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Billed To</h2>
                        <div class="flex items-center gap-3 mb-2">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold shrink-0">
                                {{ strtoupper(substr($sale->customer->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">{{ $sale->customer->name }}</p>
                                <p class="text-sm text-slate-500">{{ $sale->customer->email }}</p>
                            </div>
                        </div>
                        @if ($sale->customer->phone || $sale->customer->address)
                            <div class="text-sm text-slate-500 mt-3 space-y-1">
                                @if ($sale->customer->phone)
                                    <p>{{ $sale->customer->phone }}</p>
                                @endif
                                @if ($sale->customer->address)
                                    <p>{{ $sale->customer->address }}</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="sm:text-right">
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Payment Details</h2>
                        <p class="font-medium text-slate-900 mb-1">Status: <span class="text-emerald-600">Paid</span></p>
                        <p class="text-sm text-slate-500 mb-1">Date: {{ $sale->sale_date->format('M d, Y') }}</p>
                        <p class="text-sm text-slate-500">Method: Credit Card</p>
                    </div>
                </div>

                <!-- Invoice Table -->
                <div class="border border-slate-200 rounded-xl overflow-hidden mb-8">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-sm font-semibold text-slate-600">
                                <th class="px-6 py-4">Item Description</th>
                                <th class="px-6 py-4 text-center">Qty</th>
                                <th class="px-6 py-4 text-right">Unit Price</th>
                                <th class="px-6 py-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach ($sale->saleItems as $item)
                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $item->product->name }}
                                        <p class="text-xs text-slate-400 font-normal mt-1">SKU: {{ $item->product->sku }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-center font-medium text-slate-700">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-slate-600">
                                        ${{ number_format($item->unit_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-right font-medium text-slate-900">
                                        ${{ number_format($item->subtotal, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="flex justify-end">
                    <div class="w-full sm:w-1/2 md:w-1/3 space-y-3">
                        <div class="flex justify-between text-sm text-slate-500">
                            <span>Subtotal</span>
                            <span>${{ number_format($sale->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-slate-500">
                            <span>Tax (0%)</span>
                            <span>$0.00</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-slate-900 pt-3 border-t border-slate-200">
                            <span>Total</span>
                            <span>${{ number_format($sale->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div
                class="bg-slate-50 px-8 py-6 border-t border-slate-100 text-center sm:text-left flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-slate-500">
                    Thank you for your business. If you have any questions, please contact us.
                </p>
                <div class="text-sm font-medium text-slate-700">
                    SalesFlow CRM
                </div>
            </div>

        </div>
    </div>
@endsection
