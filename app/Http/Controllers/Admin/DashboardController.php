<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Sale::sum('total_amount');
        $totalSales = Sale::count();
        $activeCustomers = Customer::where('status', 'active')->count();
        $lowStockProducts = Product::where('stock_quantity', '<=', 10)->count();

        $topEmployees = User::where('role', 'employee')
            ->orderByDesc('kpi_score')
            ->take(5)
            ->get();

        $recentSales = Sale::with('customer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalSales',
            'activeCustomers',
            'lowStockProducts',
            'topEmployees',
            'recentSales'
        ));
    }
}
