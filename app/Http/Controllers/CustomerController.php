<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required','string','max:255'],
            'phone' => ['nullable','string','max:50'],
        ]);

        Customer::create($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'مشتری با موفقیت ایجاد شد.');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name'  => ['required','string','max:255'],
            'phone' => ['nullable','string','max:50'],
        ]);

        $customer->update($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'مشتری با موفقیت ویرایش شد.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'مشتری حذف شد.');
    }
}