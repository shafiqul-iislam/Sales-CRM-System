@extends('layouts.admin')

@section('title', 'Add Product - Sales CRM')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}"
                class="p-2 text-slate-400 hover:text-slate-700 hover:bg-white hover:shadow-sm rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Add New Product</h1>
                <p class="text-slate-500 mt-1">Create a new product in your inventory.</p>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 space-y-8">

                    <!-- General Info Section -->
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">General Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="col-span-1 md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Product Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. MacBook Pro 16&quot;"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm"
                                    required>
                                @error('name')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sku" class="block text-sm font-medium text-slate-700 mb-1.5">SKU (Stock Keeping Unit)</label>
                                <input type="text" id="sku" name="sku" value="{{ old('sku') }}" placeholder="e.g. APP-MBP-16"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('sku') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm"
                                    required>
                                @error('sku')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Pricing & Inventory Section -->
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Pricing & Inventory
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="price" class="block text-sm font-medium text-slate-700 mb-1.5">Price ($)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-medium">$</span>
                                    <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" placeholder="0.00"
                                        class="w-full pl-8 pr-4 py-2.5 bg-slate-50 border @error('price') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm"
                                        required>
                                </div>
                                @error('price')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="stock_quantity" class="block text-sm font-medium text-slate-700 mb-1.5">Stock Quantity</label>
                                <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', '0') }}" placeholder="0"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('stock_quantity') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm"
                                    required>
                                @error('stock_quantity')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Footer actions -->
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:border-slate-300 rounded-lg transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-sm shadow-blue-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Product
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
