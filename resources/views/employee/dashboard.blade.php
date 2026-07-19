@extends('layouts.employee')

@section('title', 'Employee Dashboard - Sales CRM')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Welcome back, {{ explode(' ', $employee->name)[0] }}!</h1>
            <p class="text-slate-500 mt-1">Here is your daily performance overview.</p>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        
        <!-- Assigned Customers -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500">Assigned Customers</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $assignedCustomers }}</h3>
                    <div class="flex items-center gap-1 mt-2 text-sm text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full w-fit">
                        <span>Active roster</span>
                    </div>
                </div>
                <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- KPI Score -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-slate-500">Your KPI Score</p>
                    <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $employee->kpi_score }}</h3>
                    <div class="flex items-center gap-1 mt-2 text-sm text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full w-fit">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        <span>Points</span>
                    </div>
                </div>
                <div class="p-3 bg-amber-100 text-amber-600 rounded-xl">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Quick Actions or Next Steps -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl p-6 sm:p-8 text-white shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <h2 class="text-xl font-bold mb-2">Ready to hit your targets?</h2>
            <p class="text-emerald-50 text-sm max-w-xl">Check your assigned customers, follow up on pending leads, and record new sales to boost your KPI score.</p>
        </div>
        <a href="{{ route('employee.customers.index') }}" class="px-6 py-3 bg-white text-teal-700 font-medium rounded-xl hover:bg-slate-50 transition-colors shadow-sm whitespace-nowrap">
            View My Customers
        </a>
    </div>

</div>
@endsection
