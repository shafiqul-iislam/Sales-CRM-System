@extends('layouts.admin')

@section('title', 'Add Customer - Sales CRM')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.customers.index') }}"
                class="p-2 text-slate-400 hover:text-slate-700 hover:bg-white hover:shadow-sm rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Add New Customer</h1>
                <p class="text-slate-500 mt-1">Add a new customer to your contact list.</p>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.customers.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 md:p-8 space-y-8">

                    <!-- Contact Info Section -->
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-2">Contact Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="col-span-1 md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. John Doe"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm"
                                    required>
                                @error('name')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="e.g. john@example.com"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('email') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm"
                                    required>
                                @error('email')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Phone Number (Optional)</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="e.g. +1 234 567 890"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('phone') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm">
                                @error('phone')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-slate-700 mb-1.5">Address (Optional)</label>
                                <textarea id="address" name="address" rows="3" placeholder="Full address..."
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('address') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none shadow-sm resize-y">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Footer actions -->
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.customers.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:border-slate-300 rounded-lg transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-sm shadow-blue-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Customer
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
