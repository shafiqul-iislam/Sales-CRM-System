<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAssignment;
use Illuminate\Http\Request;

class CustomerAssignmentController extends Controller
{
    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            'employee_id' => ['required', 'exists:users,id'],
        ]);

        CustomerAssignment::updateOrCreate(
            [
                'customer_id' => $customer->id,
            ],
            [
                'employee_id' => $request->employee_id,
                'assigned_at' => now(),
            ]
        );

        return back()->with(
            'success',
            'Customer assigned successfully.'
        );
    }
}
