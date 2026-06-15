<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function index()
    {
        // همه سفارش‌ها به همراه آدرس و جزئیات
        
        // همه سفارش‌ها به همراه مشتری، آدرس و آیتم‌ها
        $orders = Order::with(['customer','address','items.cafeItem'])   ->latest()          // ORDER BY created_at DESC
        ->paginate(10); 
       

        return view('admin.orders.index', compact('orders'));
    }
   

public function updateStatus(Order $order, Request $request)
{
    // اعتبارسنجی مقدار ورودی
    $request->validate([
        'status' => 'required|in:pending,preparing,sent,delivered,canceled',
    ]);

    // آپدیت وضعیت
    $order->update(['status' => $request->status]);

    // بازگشت به صفحه قبلی با پیام موفقیت
    return back()->with('success', 'وضعیت سفارش با موفقیت تغییر کرد.');
}


public function print(Order $order)
{
    $order->load([
        'customer',
        'address',
        'items.cafeItem'
    ]);

    return view('admin.orders.print', compact('order'));
}
// در OrderController
public function poll(Request $request)
{
    $lastId = (int) $request->query('last_id', 0);

    $newOrders = Order::with(['customer', 'address', 'items.cafeItem'])
        ->where('id', '>', $lastId)
        ->orderBy('id', 'desc')
        ->get()
        ->map(function ($order) {
            return [
                'id'             => $order->id,
                'phone'          => $order->customer->phone ?? '-',
                'address'        => $order->address->address ?? '-',
                'items'          => $order->items->map(fn($i) => [
                    'name'     => $i->cafeItem->name ?? '---',
                    'quantity' => $i->quantity,
                    'price'    => $i->price * $i->quantity,
                ]),
                'total_quantity' => $order->items->sum('quantity'),
                'total_price'    => $order->total_price,
                'status'         => $order->status,
                'payment_method' => $order->payment_method,
                'created_at'     => \Hekmatinasser\Verta\Verta::instance($order->created_at)
                                        ->format('Y/m/d H:i'),
                'print_url'      => route('admin.orders.print', $order->id),
                'update_url'     => route('admin.orders.updateStatus', $order->id),
            ];
        });

    return response()->json([
        'orders'     => $newOrders,
        'server_time'=> now()->toISOString(),
    ]);
}



    }
       

