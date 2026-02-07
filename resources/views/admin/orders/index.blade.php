@extends('admin.layouts.app')

@section('content')
<style>
    .orders-wrapper {
        padding: 16px;
    }

    .orders-header {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #222222;
        border-radius: 8px;
        overflow: hidden;
    }

    .orders-table thead {
        background-color: #27ae60;
        color: #fff;
    }

    .orders-table th,
    .orders-table td {
        padding: 10px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
        text-align: center;
        vertical-align: top;
        white-space: nowrap;
    }

    .orders-table tbody tr:hover {
        background-color: #f3f4f6;
    }

    .order-items {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: right;
        white-space: normal;
    }

    .order-items li {
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 4px;
    }

    .orders-pagination {
        margin-top: 24px;
        display: flex;
        justify-content: center;
    }

    /* ================= MOBILE ================= */
    @media (max-width: 768px) {

        .orders-table,
        .orders-table thead,
        .orders-table tbody,
        .orders-table th,
        .orders-table td,
        .orders-table tr {
            display: block;
            width: 100%;
        }

        .orders-table thead {
            display: none;
        }

        .orders-table tr {
            background: #151414;
            margin-bottom: 16px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            padding: 12px;
        }

        .orders-table td {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 6px 0;
            border: none;
            white-space: normal;
            text-align: right;
        }

        .orders-table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #6b7280;
            margin-left: 10px;
            white-space: nowrap;
        }
    }
</style>

<div class="orders-wrapper">

    <div class="orders-header">📦 لیست سفارشات</div>

    @if($orders->isEmpty())
        <p>هیچ سفارشی ثبت نشده است.</p>
    @else
        <table class="orders-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>شماره سفارش</th>
                    <th>شماره تماس</th>
                    <th>آدرس</th>
                    <th>آیتم‌ها</th>
                    <th>تعداد</th>
                    <th>جمع کل</th>
                    <th>تاریخ</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td data-label="#"> 
                            {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}
                        </td>

                        <td data-label="شماره سفارش">{{ $order->id }}</td>

                        <td data-label="شماره تماس">{{ $order->customer->phone ?? '-' }}</td>

                        <td data-label="آدرس">{{ $order->address->address ?? '-' }}</td>

                        <td data-label="آیتم‌ها">
                            @if($order->items->isNotEmpty())
                                <ul class="order-items">
                                    @foreach($order->items as $item)
                                        <li>
                                            {{ $item->cafeItem->name ?? '---' }}
                                            × {{ $item->quantity }}
                                            =
                                            {{ number_format($item->price * $item->quantity) }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                -
                            @endif
                        </td>

                        <td data-label="تعداد">{{ $order->items->sum('quantity') }}</td>

                        <td data-label="جمع کل">
                            {{ number_format($order->total_price) }} تومان
                        </td>

                        <td data-label="تاریخ">
                            {{ $order->created_at->format('Y-m-d H:i') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="orders-pagination">
            {{ $orders->links() }}
        </div>
    @endif

</div>
@endsection