<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
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

    // گرفتن آدرس‌ها با شماره موبایل (AJAX)
    public function getAddresses(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $addresses = Address::where('phone', $request->phone)->get();

        return response()->json($addresses);
    }

    // ثبت نهایی سفارش
    public function store(Request $request)
    {
        $request->validate([
            'phone'      => 'required|string',
            'address_id' => 'required|exists:addresses,id',
            'cart'       => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ ساخت یا پیدا کردن مشتری
            $customer = Customer::firstOrCreate(
                ['phone' => $request->phone],
                ['name' => 'مشتری']
            );

            // 2️⃣ محاسبه مبلغ کل
            $totalPrice = 0;
            foreach ($request->cart as $item) {
                $totalPrice += $item['price'] * $item['qty'];
            }

            // 3️⃣ ثبت سفارش
            $order = Order::create([
                'customer_id' => $customer->id,
                'address_id'  => $request->address_id,
                'total_price' => $totalPrice,
                'status'      => 'pending',
            ]);

            // 4️⃣ ثبت آیتم‌های سفارش (مهم‌ترین بخش)
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
                'message' => 'خطا در ثبت سفارش',
            ], 500);
        }
    }
}