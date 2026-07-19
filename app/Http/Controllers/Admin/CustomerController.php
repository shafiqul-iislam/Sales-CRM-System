<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Mail\PromotionMail;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::withCount('sales')
            ->withMax('sales', 'sale_date')
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        Customer::create($request->validated());

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customer->load('sales.saleItems.product');
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if ($customer->sales()->exists()) {
            return back()->with(
                'error',
                'This customer has sales records and cannot be deleted.'
            );
        }

        $customer->delete();

        return back()->with(
            'success',
            'Customer deleted successfully.'
        );
    }


    public function lostCustomers()
    {
        $days = 90;

        $customers = Customer::with('assignment')
            ->whereDoesntHave('sales', function ($query) use ($days) {
                $query->where('sale_date', '>=', now()->subDays($days));
            })->paginate(10);

        $employees = User::where('role', 'employee')
            ->orderBy('name')
            ->get();

        return view('admin.customers.lost', compact(
            'customers',
            'employees'
        ));
    }


    public function sendPromotion(Customer $customer)
    {
        Mail::to($customer->email)->send(new PromotionMail($customer));

        return back()->with(
            'success',
            "Promotion email sent to {$customer->email}."
        );
    }
}
