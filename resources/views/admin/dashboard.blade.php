@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <h3 class="mb-4 text-center">به پنل مدیریت خوش آمدید</h3>
        <p>از منوی کنار می‌توانید بخش‌های مختلف سایت را مدیریت کنید.</p>

    

          {{-- آمار داشبورد --}}
    
<div class="row mt-4">

    {{-- تراکنش‌های موفق امروز --}}
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-3">تراکنش‌های موفق امروز</h6>

                <h2 class="text-success fw-bold">
                    {{ number_format($successfulPaymentsToday ?? 0) }}
                </h2>

                <small class="text-muted">تعداد پرداخت‌های موفق</small>
            </div>
        </div>
    </div>

    {{-- درآمد امروز --}}
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <h6 class="text-muted mb-3">درآمد امروز</h6>

                <h2 class="text-primary fw-bold">
                    {{ number_format($todayRevenue ?? 0) }}
                </h2>

                <small class="text-muted">تومان</small>
            </div>
        </div>
    </div>

    {{-- سه محصول پرفروش --}}
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 h-100">

            <div class="card-header bg-white py-3">
                <h6 class="mb-0">۳ محصول پرفروش رستوران</h6>
            </div>

            <div class="card-body">
                @if($topSellingItems->count() > 0)

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>رتبه</th>
                                    <th>محصول</th>
                                    <th>تعداد</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($topSellingItems as $index => $item)
                                    <tr>
                                        <td>
                                            @if($index == 0)
                                                🥇
                                            @elseif($index == 1)
                                                🥈
                                            @else
                                                🥉
                                            @endif
                                        </td>

                                        <td>{{ $item->name }}</td>

                                        <td>
                                            <span class="badge bg-success">
                                                {{ number_format($item->sold_quantity) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <div class="text-center text-muted py-4">
                        هنوز فروشی ثبت نشده است.
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>


    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">۱۰ سفارش در انتظار تأیید</h5>
        </div>
    
        <div class="card-body">
            @if($pendingOrders->count() > 0)
    
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>شماره سفارش</th>
                                <th>مبلغ سفارش</th>
                                <th>تاریخ ثبت</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach($pendingOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
    
                                    <td>
                                        {{ number_format($order->total_price) }}
                                        تومان
                                    </td>
    
                                    <td>
                                         {{ verta($order->created_at)->format('Y/m/d H:i') }} 
                                    </td>
    
                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            در انتظار تأیید
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
            @else
                <div class="text-center text-muted py-4">
                    در حال حاضر سفارشی در انتظار تأیید وجود ندارد.
                </div>
            @endif
        </div>
    </div>
    

  

@endsection
