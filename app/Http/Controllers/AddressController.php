<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // ثبت آدرس
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'address' => 'required|string',
        ]);

        $customer = auth('customer')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $address = $customer->addresses()->create([
            'title' => $request->title,
            'address' => $request->address,
        ]);

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }

    // گرفتن لیست آدرس‌ها (اصلاح شده)
    public function index()
    {
        $customer = auth('customer')->user();

        if (!$customer) {
            return response()->json([], 401);
        }

        return response()->json($customer->addresses);
    }
    

   

    }
