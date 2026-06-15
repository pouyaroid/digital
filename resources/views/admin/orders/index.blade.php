@extends('admin.layouts.app')

@section('content')


<style>
    :root {
        --primary-color: #27ae60; /* رنگ سبز اصلی */
        --primary-hover: #219150;
        --bg-color: #f3f4f6;
        --card-bg: #ffffff;
        --text-main: #1f2937;
        --text-muted: #6b7280;
        --border-color: #e5e7eb;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .orders-wrapper {
        font-family: 'Vazir', sans-serif;
        padding: 24px;
        background-color: var(--bg-color);
        min-height: 100vh;
        direction: rtl;
    }

    /* Header Styles */
    .orders-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .orders-header h2 {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Table Container (Card Style) */
    .table-container {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        overflow: hidden; /* برای گرد کردن گوشه‌ها */
        border: 1px solid var(--border-color);
    }

    /* Table Styles */
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        text-align: right;
    }

    .orders-table thead {
        background-color: var(--primary-color);
        color: #fff;
    }

    .orders-table th {
        padding: 16px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .orders-table td {
        padding: 16px;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
        font-size: 14px;
        vertical-align: top;
    }

    .orders-table tbody tr:last-child td {
        border-bottom: none;
    }

    .orders-table tbody tr:hover {
        background-color: #f9fafb;
        transition: background-color 0.2s;
    }

    /* Order Items List Styling */
    .order-items {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .order-items li {
        background-color: #f9fafb;
        padding: 8px 12px;
        border-radius: 6px;
        margin-bottom: 6px;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        border: 1px solid #eee;
    }
    
    .order-items li:last-child {
        margin-bottom: 0;
    }

    .item-name {
        font-weight: 600;
        color: var(--text-main);
    }

    .item-detail {
        color: var(--text-muted);
        font-size: 12px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }
    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
        display: block;
        opacity: 0.5;
    }

    /* Pagination Styling (Override Bootstrap/Laravel Default) */
    .orders-pagination {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    
    .orders-pagination a, 
    .orders-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid var(--border-color);
        background-color: var(--card-bg);
        color: var(--text-main);
    }

    .orders-pagination a:hover {
        background-color: var(--bg-color);
        border-color: var(--text-muted);
    }

    .orders-pagination .active span {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    /* ================= RESPONSIVE (MOBILE) ================= */
    @media (max-width: 768px) {
        .orders-wrapper {
            padding: 16px;
        }

        .orders-table,
        .orders-table thead,
        .orders-table tbody,
        .orders-table th,
        .orders-table td,
        .orders-table tr {
            display: block;
            width: 100%;
        }

        /* مخفی کردن هدر جدول در موبایل */
        .orders-table thead {
            display: none;
        }

        .orders-table tr {
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            overflow: hidden; /* برای اینکه سایز کارت از بیرون نزند */
        }

        .orders-table td {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            text-align: right;
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
            position: relative;
            white-space: normal;
        }

        .orders-table td::before {
            content: attr(data-label);
            font-weight: 700;
            color: var(--text-muted);
            font-size: 13px;
            margin-left: 12px;
            min-width: 80px;
        }

        /* بهبود نمایش ستون آیتم‌ها در موبایل */
        .orders-table td[data-label="آیتم‌ها"] {
            display: block;
            flex-direction: column;
        }
        
        .orders-table td[data-label="آیتم‌ها"]::before {
            margin-bottom: 8px;
            display: block;
        }
        
        /* استایل خاص برای اخرین کارت */
        .orders-table tr:last-child {
            margin-bottom: 0;
        }
    }
</style>

<div class="orders-wrapper">

    <div class="orders-header">
        <h2>📦 لیست سفارشات</h2>
    </div>

    @if($orders->isEmpty())
        <div class="empty-state">
            <span class="empty-icon">📭</span>
            <p>هیچ سفارشی ثبت نشده است.</p>
        </div>
    @else
        <div class="table-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>شماره سفارش</th>
                        <th>شماره تماس</th>
                        <th>آدرس</th>
                        <th>آیتم‌ها</th>
                        <th>تعداد کل</th>
                        <th>جمع کل</th>
                        <!-- اضافه کردن ستون وضعیت -->
                        <th>وضعیت</th>
                        <th>روش پرداخت</th>
                        <th>تاریخ</th>
                        <th>چاپ</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td data-label="#">
                            {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}
                        </td>

                        <td data-label="شماره سفارش">
                            <span style="font-family: sans-serif; font-weight: bold;">{{ $order->id }}</span>
                        </td>

                        <td data-label="شماره تماس">
                            {{ $order->customer->phone ?? '-' }}
                        </td>

                        <td data-label="آدرس">
                            <span style="max-width: 200px; display: block; overflow: hidden; text-overflow: ellipsis;">
                                {{ $order->address->address ?? '-' }}
                            </span>
                        </td>

                        <td data-label="آیتم‌ها">
                            @if($order->items->isNotEmpty())
                                <ul class="order-items">
                                    @foreach($order->items as $item)
                                        <li>
                                            <span class="item-name">{{ $item->cafeItem->name ?? '---' }}</span>
                                            <span class="item-detail">
                                                {{ $item->quantity }} عدد
                                                <span style="margin: 0 4px;">•</span>
                                                {{ number_format($item->price * $item->quantity) }} تومان
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td data-label="تعداد کل">
                            {{ $order->items->sum('quantity') }}
                        </td>

                        <td data-label="جمع کل">
                            <strong style="color: var(--primary-color);">
                                {{ number_format($order->total_price) }} <span style="font-size: 0.8em">تومان</span>
                            </strong>
                        </td>

                        <!-- --- بخش جدید: ستون وضعیت و فرم تغییر --- -->
                        <td data-label="وضعیت">
                            <!-- تعیین کلاس رنگی بر اساس وضعیت -->
                            @php
                                $statusColor = match($order->status) {
                                    'pending' => '#f59e0b', // نارنجی
                                    'preparing' => '#3b82f6', // آبی
                                    'sent' => '#8b5cf6', // بنفش
                                    'delivered' => '#10b981', // سبز
                                    'canceled' => '#ef4444', // قرمز
                                    default => '#6b7280',
                                };
                            @endphp

                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display: flex; align-items: center; gap: 5px;">
                                @csrf
                                @method('PATCH')
                                
                                <div style="display: flex; align-items: center; background: #f3f4f6; padding: 4px; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <!-- نمایش رنگ وضعیت -->
                                    <span style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $statusColor }}; display: inline-block; margin-left: 5px;"></span>
                                    
                                    <select name="status" onchange="this.form.submit()" style="border: none; background: transparent; padding: 2px; font-size: 0.9em; cursor: pointer; outline: none;">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>درحال پردازش</option>
                                        <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>آماده‌سازی</option>
                                        <option value="sent" {{ $order->status === 'sent' ? 'selected' : '' }}>ارسال شده</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>تحویل داده شد</option>
                                        <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>لغو شده</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                        <!-- --- پایان بخش جدید --- -->
                        <td data-label="روش پرداخت">
                            @php
                                $paymentMethod = match($order->payment_method) {
                                    'online' => '💳 پرداخت آنلاین',
                                    'cash' => '💵 پرداخت در محل',
                                    default => '-',
                                };
                            @endphp
                        
                            {{ $paymentMethod }}
                        </td>
                        <td data-label="تاریخ">
                            <small>
                                {{ \Hekmatinasser\Verta\Verta::instance($order->created_at)->format('Y/m/d H:i') }}
                            </small>
                        </td>
                        <td data-label="چاپ">
                            <a href="{{ route('admin.orders.print', $order->id) }}"
                               target="_blank"
                               style="
                                    display:inline-flex;
                                    align-items:center;
                                    justify-content:center;
                                    padding:6px 10px;
                                    background:#111827;
                                    color:#fff;
                                    text-decoration:none;
                                    border-radius:8px;
                                    font-size:13px;
                                    font-weight:600;
                               ">
                                🖨 چاپ
                            </a>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="orders-pagination">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection