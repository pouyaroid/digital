<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeItem;
use App\Models\Order;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        // تعداد تراکنش‌های موفق امروز
        $successfulPaymentsToday = Payment::where('status', 'success')
            ->whereDate('created_at', today())
            ->count();
            // مجموع مبلغ تراکنش‌های موفق امروز
        $todayRevenue = Payment::where('status', 'success')
            ->whereDate('updated_at', today())
            ->sum('amount');

           // ۱۰ سفارش آخر در انتظار تأیید
           $pendingOrders =Order::where('status', 'pending')
           ->latest()
           ->take(10)
           ->get();

          // ۳ محصول پرفروش بر اساس تعداد خرید
          
// ۳ محصول پرفروش بر اساس تعداد خریدهای موفق
$topSellingItems = CafeItem::query()
->join('order_items', 'cafe_items.id', '=', 'order_items.cafe_item_id')
->join('orders', 'orders.id', '=', 'order_items.order_id')
->join('payments', 'payments.order_id', '=', 'orders.id')
->where('payments.status', 'success')
->select(
    'cafe_items.id',
    'cafe_items.name',
    'cafe_items.image'
)
->selectRaw('SUM(order_items.quantity) as sold_quantity')
->groupBy(
    'cafe_items.id',
    'cafe_items.name',
    'cafe_items.image'
)
->orderByDesc('sold_quantity')
->take(3)
->get();


    
        return view('admin.dashboard', compact(
            'successfulPaymentsToday', 'todayRevenue','pendingOrders','topSellingItems'

        
        ));
    }
}