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
    }
    

