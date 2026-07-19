<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\CustomerAssignment;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = CustomerAssignment::with('customer')
            ->where('employee_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('employee.customers.index', compact('customers'));
    }

    public function show($customer)
    {
        $assignment = CustomerAssignment::with([
            'customer.sales.saleItems.product'
        ])
            ->where('employee_id', auth()->id())
            ->where('customer_id', $customer)
            ->firstOrFail();

        return view(
            'employee.customers.show',
            compact('assignment')
        );
    }
}
