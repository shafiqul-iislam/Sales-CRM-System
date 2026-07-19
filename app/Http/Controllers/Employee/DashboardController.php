<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\CustomerAssignment;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $employee = auth()->user();

        $assignedCustomers = CustomerAssignment::where(
            'employee_id',
            $employee->id
        )->count();

        return view('employee.dashboard', compact(
            'employee',
            'assignedCustomers'
        ));
    }
}
