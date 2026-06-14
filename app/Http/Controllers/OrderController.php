<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // صفحه checkout
    public function checkout()
{
    $settings = MenuSetting::first();

    return view('checkout', compact('settings'));
}

    // گرفتن آدرس‌ها
    public function getAddresses()
    {
        $customer = auth('customer')->user();

        if (!$customer) {
            return response()->json([], 401);
        }

        return response()->json($customer->addresses);
    }

    // ثبت سفارش
    public function store(Request $request)
    {
        $request->validate([
            'address_id'     => 'required|exists:addresses,id',
            'cart'           => 'required|array|min:1',
            'payment_method' => 'required|in:online,cash',
        ]);

        $customer = auth('customer')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // 🔥 گرفتن تنظیمات پرداخت
        $settings = MenuSetting::first();

        // ❌ اگر کل سیستم سفارش بسته باشد
        if (!$settings->cash_payment_enabled && !$settings->online_payment_enabled) {
            return response()->json([
                'success' => false,
                'message' => 'در حال حاضر از پذیرش سفارش معذوریم'
            ], 403);
        }

        // ❌ اگر روش انتخابی غیرفعال باشد
        if (
            ($request->payment_method === 'online' && !$settings->online_payment_enabled) ||
            ($request->payment_method === 'cash' && !$settings->cash_payment_enabled)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'این روش پرداخت در حال حاضر فعال نیست'
            ], 403);
        }

        DB::beginTransaction();

        try {

            // 💰 محاسبه قیمت
            $totalPrice = collect($request->cart)
                ->sum(fn($item) => $item['price'] * $item['qty']);

            // 🧾 ساخت سفارش
            $order = Order::create([
                'customer_id'    => $customer->id,
                'address_id'     => $request->address_id,
                'total_price'    => $totalPrice,
                'status'         => 'pending',
                'payment_method' => $request->payment_method,
            ]);

            // 📦 آیتم‌ها
            foreach ($request->cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'cafe_item_id' => $item['id'],
                    'price'        => $item['price'],
                    'quantity'     => $item['qty'],
                ]);
            }

            DB::commit();

            // 💳 مسیر پرداخت
            if ($request->payment_method === 'online') {
                return response()->json([
                    'success'  => true,
                    'order_id' => $order->id,
                    'redirect' => route('payment.pay', $order->id),
                ]);
            }

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