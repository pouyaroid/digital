<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

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
    }
    

