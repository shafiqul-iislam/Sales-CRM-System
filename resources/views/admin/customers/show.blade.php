@extends('layouts.admin')

@section('title', 'Customer Purchase History - Sales CRM')

@section('content')
<div class="space-y-6">

    <!-- Header & Back Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.customers.index') }}"
                class="p-2 text-slate-400 hover:text-slate-700 hover:bg-white hover:shadow-sm rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ $customer->name }}</h1>
                <p class="text-slate-500 mt-1">Customer Profile & Purchase History</p>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="px-5 py-2.5 bg-white text-slate-700 border border-slate-200 font-medium rounded-xl hover:bg-slate-50 transition-all flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Customer
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Contact Information Card -->
        <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl shrink-0">
                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">{{ $customer->name }}</h2>
                    <p class="text-sm text-slate-500">Customer since {{ $customer->created_at->format('M Y') }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50">
                    <svg class="w-5 h-5 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-0.5">Email Address</p>
                        <p class="text-sm font-semibold text-slate-900 break-all">{{ $customer->email }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50">
                    <svg class="w-5 h-5 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-0.5">Phone Number</p>
                        <p class="text-sm font-semibold text-slate-900">{{ $customer->phone ?: 'Not provided' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50">
                    <svg class="w-5 h-5 text-slate-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-0.5">Physical Address</p>
                        <p class="text-sm font-semibold text-slate-900">{{ $customer->address ?: 'Not provided' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-slate-100">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Total Purchases</p>
                        <p class="text-xl font-bold text-slate-900">{{ $customer->sales->count() }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Lifetime Value</p>
                        <p class="text-xl font-bold text-emerald-600">${{ number_format($customer->sales->sum('total_amount'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales History -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-900">Purchase History</h2>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-slate-100 text-sm font-medium text-slate-500">
                            <th class="px-6 py-4">Invoice ID</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Items</th>
                            <th class="px-6 py-4 text-right">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm bg-white">
                        @forelse($customer->sales as $sale)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-slate-900">#INV-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    <div class="flex flex-col gap-1 text-xs">
                                        @foreach($sale->saleItems as $item)
                                            <div>
                                                <span class="font-semibold">{{ optional($item->product)->name ?? 'Unknown Product' }}</span>
                                                <span class="text-slate-400">x{{ $item->quantity }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-bold text-slate-900">${{ number_format($sale->total_amount, 2) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-50 mb-3">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <p class="text-slate-500 text-sm">No purchases recorded yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
