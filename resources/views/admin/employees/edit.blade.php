@extends('layouts.admin')

@section('title', 'Edit Employee - Sales CRM')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.employees.index') }}"
                class="p-2 text-slate-400 hover:text-slate-700 hover:bg-white hover:shadow-sm rounded-xl transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Edit Employee</h1>
                <p class="text-slate-500 mt-1">Update information for {{ $employee->name }}.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <form action="{{ route('admin.employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-6 md:p-8 space-y-6">
                    
                    <!-- Basic Info Section -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Full Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none"
                                    placeholder="e.g. John Doe">
                                @error('name')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('phone') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none"
                                    placeholder="e.g. +1 234 567 8900">
                                @error('phone')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <hr class="border-slate-100">

                    <!-- Account Info Section -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Account Setup</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address *</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" required
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('email') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none"
                                    placeholder="john@example.com">
                                @error('email')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Reset Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-2.5 bg-slate-50 border @error('password') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none"
                                    placeholder="Leave blank to keep current">
                                @error('password')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-slate-500 mt-1.5">Only fill this if you want to change the password.</p>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Account Status *</label>
                                <div class="relative">
                                    <select name="status" id="status" required
                                        class="w-full px-4 py-2.5 bg-slate-50 border @error('status') border-rose-300 focus:border-rose-500 focus:ring-rose-200 @else border-slate-200 focus:border-blue-500 focus:ring-blue-200 @enderror rounded-xl text-sm focus:bg-white focus:ring-2 transition-all outline-none appearance-none">
                                        <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                @error('status')
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.employees.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:border-slate-300 rounded-xl transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors shadow-sm shadow-blue-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection