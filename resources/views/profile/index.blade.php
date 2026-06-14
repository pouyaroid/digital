@extends('admin.layouts.main')

@section('title', 'پنل کاربری')

@section('content')

<div class="container py-5">

    <div class="row g-4">

        {{-- Sidebar --}}
        <div class="col-12 col-lg-3">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto"
                             style="width:70px;height:70px;font-size:24px;">
                            {{ mb_substr($customer->name ?? 'م', 0, 1) }}
                        </div>
                    </div>

                    <h6 class="fw-bold mb-1">{{ $customer->name ?? 'کاربر' }}</h6>
                    <small class="text-muted">{{ $customer->phone ?? '' }}</small>

                </div>
            </div>

            <div class="list-group mt-3 shadow-sm rounded-4 overflow-hidden">
                <a href="#addresses" class="list-group-item list-group-item-action">📍 آدرس‌ها</a>
                <a href="#orders" class="list-group-item list-group-item-action">🧾 سفارش‌ها</a>
            </div>

        </div>

        {{-- Content --}}
        <div class="col-12 col-lg-9">

            {{-- Addresses --}}
            <div id="addresses" class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">📍 مدیریت آدرس‌ها</h5>

                    {{-- Add Address --}}
                    <form id="addressForm" class="row g-2 mb-3">
                        <input type="hidden" name="phone" value="{{ $customer->phone }}">

                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control" placeholder="عنوان (مثلاً خانه)">
                        </div>

                        <div class="col-md-6">
                            <input type="text" name="address" class="form-control" placeholder="آدرس کامل">
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-success w-100">ثبت</button>
                        </div>
                    </form>

                    {{-- List --}}
                    <div id="addressList" class="list-group"></div>

                </div>
            </div>

            {{-- Orders --}}
            <div id="orders" class="card border-0 shadow-sm rounded-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">🧾 سفارش‌های من</h5>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>شماره</th>
                                    <th>مبلغ</th>
                                    <th>وضعیت</th>
                                    <th>وضعیت پرداخت</th>
                                    <th>تاریخ</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($customer->orders ?? [] as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                            
                                    <td>{{ number_format($order->total_price) }} تومان</td>
                            
                                    {{-- وضعیت سفارش --}}
                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="badge bg-warning">در انتظار</span>
                                        @elseif($order->status == 'preparing')
                                            <span class="badge bg-info">در حال آماده‌سازی</span>
                                        @else
                                            <span class="badge bg-success">تحویل شده</span>
                                        @endif
                                    </td>
                            
                                    {{-- وضعیت پرداخت --}}
                                    <td>
                                        @if($order->payment_method == 'cash')
                                            <span class="badge bg-primary">پرداخت در محل</span>
                            
                                        @elseif(optional($order->payments)->status == 'success')
                                            <span class="badge bg-success">پرداخت شده</span>
                            
                                        @elseif(optional($order->payments)->status == 'pending')
                                            <span class="badge bg-warning">در انتظار پرداخت</span>
                            
                                        @else
                                            <span class="badge bg-danger">ناموفق</span>
                                        @endif
                                    </td>
                            
                                    {{-- تاریخ --}}
                                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        سفارشی ثبت نشده
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

@endsection
@push('scripts')
<script>
document.getElementById('addressForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('address.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        loadAddresses();
    });
});

function loadAddresses() {
    fetch("{{ route('address.index') }}")
    .then(res => res.json())
    .then(data => {

        let html = '';

        data.forEach(item => {
            html += `
                <div class="list-group-item">
                    <strong>${item.title ?? 'بدون عنوان'}</strong><br>
                    <small>${item.address}</small>
                </div>
            `;
        });

        document.getElementById('addressList').innerHTML = html;
    })
    .catch(err => {
        console.error(err);
    });
}

// init
loadAddresses();
</script>
@endpush