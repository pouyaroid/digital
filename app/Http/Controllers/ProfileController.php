<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $customer = Customer::with([
            'orders' => function ($q) {
                $q->orderByDesc('id');
            },
            'orders.payments'
        ])->find(auth('customer')->id());
    
        return view('profile.index', compact('customer'));
    }
}
