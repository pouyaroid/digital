<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // صفحه checkout
    public function checkout()
    {
        return view('checkout');
    }

    // گرفتن آدرس‌ها (امن)
    public function getAddresses()
    {
        $customer = auth('customer')->user();

        if (!$customer) {
            return response()->json([], 401);
        }

        return response()->json($customer->addresses);
    }

    // ثبت سفارش (نسخه امن)
    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'cart'       => 'required|array|min:1',
        ]);

        $customer = auth('customer')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        DB::beginTransaction();

        try {

            // 1️⃣ محاسبه مبلغ کل
            $totalPrice = 0;

            foreach ($request->cart as $item) {
                $totalPrice += $item['price'] * $item['qty'];
            }

            // 2️⃣ ساخت سفارش
            $order = Order::create([
                'customer_id' => $customer->id,
                'address_id'  => $request->address_id,
                'total_price' => $totalPrice,
                'status'      => 'pending',
            ]);

            // 3️⃣ آیتم‌ها
            foreach ($request->cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'cafe_item_id' => $item['id'],
                    'price'        => $item['price'],
                    'quantity'     => $item['qty'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success'  => true,
                'order_id' => $order->id,
            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'خطا در ثبت سفارش'
            ], 500);
        }
    }
}