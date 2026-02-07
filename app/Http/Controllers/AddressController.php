<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;

class AddressController extends Controller
{
public function byPhone(Request $request)
{
    $phone = $request->phone;

    $customer = Customer::where('phone', $phone)->first();

    return response()->json(
        $customer ? $customer->addresses : []
    );
}

public function store(Request $request)
{
    $request->validate([
        'phone' => 'required',
        'address' => 'required|string'
    ]);

    $customer = Customer::firstOrCreate(
        ['phone' => $request->phone],
        ['name' => 'مشتری']
    );

    $address = Address::create([
        'customer_id' => $customer->id,
        'title' => $request->title ?? null,
        'address' => $request->address,
    ]);

    return response()->json($address);
}
}