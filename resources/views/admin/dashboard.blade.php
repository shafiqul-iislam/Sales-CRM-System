@extends('layouts.admin')

@section('title', 'Dashboard - Sales CRM')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard Overview</h1>
            <p class="text-slate-500 mt-1">Welcome back, here's what's happening today.</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm shadow-blue-200 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Export Report
        </button>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Revenue</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">${{ number_format($totalRevenue, 2) }}</h3>
                </div>
                <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Sales -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Sales</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ number_format($totalSales) }}</h3>
                </div>
                <div class="p-3 bg-indigo-100 text-indigo-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Active Customers -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500">Active Customers</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ number_format($activeCustomers) }}</h3>
                </div>
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-rose-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500">Low Stock Alerts</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $lowStockProducts }}</h3>
                    @if($lowStockProducts > 0)
                        <div class="flex items-center gap-1 mt-2 text-sm text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full w-fit">
                            <span>Requires Attention</span>
                        </div>
                    @endif
                </div>
                <div class="p-3 bg-rose-100 text-rose-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Top Employees Leaderboard -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-slate-900">Top Performers</h2>
                <a href="{{ route('admin.employees.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">Manage Team</a>
            </div>
            
            <div class="space-y-4 flex-1">
                @forelse($topEmployees as $index => $employee)
                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 text-sm">
                                #{{ $index + 1 }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $employee->name }}</p>
                                <p class="text-xs text-slate-500">{{ $employee->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="font-bold text-slate-700">{{ $employee->kpi_score }} Points</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-slate-500">
                        <p>No employees found.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Sales Table -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-slate-900">Recent Sales</h2>
                <a href="{{ route('admin.sales.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">View All</a>
            </div>

            <div class="space-y-4 flex-1">
                @forelse($recentSales as $sale)
                <div class="flex items-center justify-between pb-4 border-b border-slate-50 last:border-0 last:pb-0 group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-600 font-bold text-sm shadow-inner group-hover:scale-105 transition-transform">
                            {{ substr($sale->customer->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">{{ $sale->customer->name ?? 'Unknown Customer' }}</p>
                            <p class="text-xs text-slate-500">{{ $sale->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-slate-900">${{ number_format($sale->total_amount, 2) }}</p>
                        <p class="text-xs text-emerald-600 font-medium">Completed</p>
                    </div>
                </div>
                @empty
                    <div class="text-center py-8 text-slate-500">
                        <p>No recent sales found.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
