@extends('admin.layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #27ae60;
        --primary-hover: #219150;
        --bg-color: #f3f4f6;
        --card-bg: #ffffff;
        --text-main: #1f2937;
        --text-muted: #6b7280;
        --border-color: #e5e7eb;
        --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
    }

    .orders-wrapper {
        font-family: 'Vazir', sans-serif;
        padding: 24px;
        background-color: var(--bg-color);
        min-height: 100vh;
        direction: rtl;
    }

    .orders-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
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

    /* نشانگر وضعیت real-time */
    .live-indicator {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 13px;
        color: #065f46;
        font-weight: 600;
    }

    .live-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #10b981;
        animation: pulse-dot 1.5s infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.4; transform: scale(0.8); }
    }

    /* تست صدا */
    .btn-test-sound {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #1f2937;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 13px;
        cursor: pointer;
        font-family: 'Vazir', sans-serif;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-test-sound:hover { background: #374151; }

    .table-container {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

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

    .orders-table tbody tr:last-child td { border-bottom: none; }
    .orders-table tbody tr:hover { background-color: #f9fafb; transition: background-color 0.2s; }

    /* انیمیشن ردیف جدید */
    @keyframes slideInFromTop {
        from { opacity: 0; transform: translateY(-20px); background-color: #d1fae5; }
        to   { opacity: 1; transform: translateY(0);    background-color: transparent; }
    }

    .new-order-row {
        animation: slideInFromTop 0.8s ease forwards;
    }

    .order-items { list-style: none; padding: 0; margin: 0; }
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
    .order-items li:last-child { margin-bottom: 0; }
    .item-name   { font-weight: 600; color: var(--text-main); }
    .item-detail { color: var(--text-muted); font-size: 12px; }

    .empty-state  { text-align: center; padding: 60px 20px; color: var(--text-muted); }
    .empty-icon   { font-size: 48px; margin-bottom: 16px; display: block; opacity: 0.5; }

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
    .orders-pagination a:hover { background-color: var(--bg-color); border-color: var(--text-muted); }
    .orders-pagination .active span { background-color: var(--primary-color); color: white; border-color: var(--primary-color); }

    @media (max-width: 768px) {
        .orders-wrapper { padding: 16px; }

        .orders-table, .orders-table thead, .orders-table tbody,
        .orders-table th, .orders-table td, .orders-table tr { display: block; width: 100%; }

        .orders-table thead { display: none; }

        .orders-table tr {
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .orders-table td {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            text-align: right;
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
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

        .orders-table td[data-label="آیتم‌ها"] { display: block; }
        .orders-table td[data-label="آیتم‌ها"]::before { margin-bottom: 8px; display: block; }
        .orders-table tr:last-child { margin-bottom: 0; }
    }
</style>

<div class="orders-wrapper">

    <div class="orders-header">
        <h2>📦 لیست سفارشات</h2>
        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
            <div class="live-indicator">
                <span class="live-dot"></span>
                <span id="live-status">آنلاین - بروزرسانی خودکار</span>
            </div>
            <button class="btn-test-sound" onclick="playAlarm(); testNotification()">
                🔔 تست آلارم
            </button>
        </div>
    </div>

    {{-- جدول اصلی --}}
    <div class="table-container" id="orders-table-container">
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
                    <th>وضعیت</th>
                    <th>روش پرداخت</th>
                    <th>وضعیت پرداخت</th>
                    <th>تاریخ</th>
                    <th>توضیحات</th>
                    <th>چاپ</th>
                </tr>
            </thead>
            <tbody id="orders-tbody">

                @if($orders->isEmpty())
                    <tr id="empty-row">
                        <td colspan="13">
                            <div class="empty-state">
                                <span class="empty-icon">📭</span>
                                <p>هیچ سفارشی ثبت نشده است.</p>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach($orders as $order)
                    @php
                        $statusColor = match($order->status) {
                            'pending'   => '#f59e0b',
                            'preparing' => '#3b82f6',
                            'sent'      => '#8b5cf6',
                            'delivered' => '#10b981',
                            'canceled'  => '#ef4444',
                            default     => '#6b7280',
                        };
                        $paymentLabel = match($order->payment_method) {
                            'online' => '💳 پرداخت آنلاین',
                            'cash'   => '💵 پرداخت در محل',
                            default  => '-',
                        };
                    @endphp
                    <tr data-order-id="{{ $order->id }}">
                        <td data-label="#">{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                        <td data-label="شماره سفارش"><span style="font-family:sans-serif;font-weight:bold;">{{ $order->id }}</span></td>
                        <td data-label="شماره تماس">{{ $order->customer->phone ?? '-' }}</td>
                        <td data-label="آدرس"><span style="max-width:200px;display:block;overflow:hidden;text-overflow:ellipsis;">{{ $order->address->address ?? '-' }}</span></td>
                        <td data-label="آیتم‌ها">
                            @if($order->items->isNotEmpty())
                                <ul class="order-items">
                                    @foreach($order->items as $item)
                                        <li>
                                            <span class="item-name">{{ $item->cafeItem->name ?? '---' }}</span>
                                            <span class="item-detail">{{ $item->quantity }} عدد <span style="margin:0 4px">•</span> {{ number_format($item->price * $item->quantity) }} تومان</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td data-label="تعداد کل">{{ $order->items->sum('quantity') }}</td>
                        <td data-label="جمع کل"><strong style="color:var(--primary-color);">{{ number_format($order->total_price) }} <span style="font-size:0.8em">تومان</span></strong></td>
                        <td data-label="وضعیت">
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:flex;align-items:center;gap:5px;">
                                @csrf @method('PATCH')
                                <div style="display:flex;align-items:center;background:#f3f4f6;padding:4px;border-radius:8px;border:1px solid #e5e7eb;">
                                    <span style="width:10px;height:10px;border-radius:50%;background-color:{{ $statusColor }};display:inline-block;margin-left:5px;"></span>
                                    <select name="status" onchange="this.form.submit()" style="border:none;background:transparent;padding:2px;font-size:0.9em;cursor:pointer;outline:none;">
                                        <option value="pending"   {{ $order->status==='pending'   ? 'selected' : '' }}>درحال پردازش</option>
                                        <option value="preparing" {{ $order->status==='preparing' ? 'selected' : '' }}>آماده‌سازی</option>
                                        <option value="sent"      {{ $order->status==='sent'      ? 'selected' : '' }}>ارسال شده</option>
                                        <option value="delivered" {{ $order->status==='delivered' ? 'selected' : '' }}>تحویل داده شد</option>
                                        <option value="canceled"  {{ $order->status==='canceled'  ? 'selected' : '' }}>لغو شده</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                        <td data-label="روش پرداخت">{{ $paymentLabel }}</td>
                        <td data-label="وضعیت پرداخت">

                            @if($order->payment_method === 'cash')
                                <span style="background:#dbeafe;color:#1d4ed8;padding:4px 8px;border-radius:6px;">
                                    پرداخت در محل
                                </span>
                        
                            @elseif(optional($order->payments)->status === 'success')
                                <span style="background:#dcfce7;color:#166534;padding:4px 8px;border-radius:6px;">
                                    پرداخت موفق
                                </span>
                        
                            @elseif(optional($order->payments)->status === 'pending')
                                <span style="background:#fef3c7;color:#92400e;padding:4px 8px;border-radius:6px;">
                                    در انتظار پرداخت
                                </span>
                        
                            @elseif(optional($order->payments)->status === 'failed')
                                <span style="background:#fee2e2;color:#991b1b;padding:4px 8px;border-radius:6px;">
                                    پرداخت ناموفق
                                </span>
                        
                            @else
                                <span style="background:#f3f4f6;color:#6b7280;padding:4px 8px;border-radius:6px;">
                                    نامشخص
                                </span>
                            @endif
                        
                        </td>
                        <td data-label="تاریخ"><small>{{ \Hekmatinasser\Verta\Verta::instance($order->created_at)->format('Y/m/d H:i') }}</small></td>
                        <td data-label="توضیحات مشتری">
                            @if($order->note)
                                <div style="max-width:250px; white-space:pre-wrap;">
                                    {{ $order->note }}
                                </div>
                            @else
                                <span style="color:#9ca3af;">-</span>
                            @endif
                        </td>
                        <td data-label="چاپ">
                            <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank"
                               style="display:inline-flex;align-items:center;justify-content:center;padding:6px 10px;background:#111827;color:#fff;text-decoration:none;border-radius:8px;font-size:13px;font-weight:600;">
                                🖨 چاپ
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>

    <div class="orders-pagination">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</div>

{{-- ==================== JavaScript ==================== --}}
<script>
    (function () {
        'use strict';
    
        const POLL_INTERVAL = 10000;
        const POLL_URL = @json(url('/admin/orders/poll'));
        const CSRF_TOKEN = "{{ csrf_token() }}";
    
        let lastKnownId = getMaxOrderId();
        let audioCtx    = null;
    
        /* ─── Audio ─── */
        function createAudioContext() {
            if (!audioCtx) {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
            return audioCtx;
        }
    
        function playAlarm() {
            try {
                const ctx = createAudioContext();
                [0, 200, 400].forEach(delay => {
                    const oscillator = ctx.createOscillator();
                    const gainNode   = ctx.createGain();
                    oscillator.connect(gainNode);
                    gainNode.connect(ctx.destination);
                    oscillator.type = 'sine';
                    oscillator.frequency.value = 880;
                    gainNode.gain.setValueAtTime(0.6, ctx.currentTime + delay / 1000);
                    gainNode.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + delay / 1000 + 0.3);
                    oscillator.start(ctx.currentTime + delay / 1000);
                    oscillator.stop(ctx.currentTime + delay / 1000 + 0.3);
                });
            } catch (e) {
                console.warn('AudioContext error:', e);
            }
        }
    
        /* ─── Notification ─── */
        function requestNotificationPermission() {
            if ('Notification' in window && Notification.permission === 'default') {
                Notification.requestPermission();
            }
        }
    
        function sendNotification(count) {
            if (!('Notification' in window) || Notification.permission !== 'granted') return;
            new Notification('📦 سفارش جدید!', {
                body: `${count} سفارش جدید دریافت شد`,
                icon: '/favicon.ico',
                badge: '/favicon.ico',
                tag: 'new-order',
                renotify: true,
            });
        }
    
        window.testNotification = function () {
            if (!('Notification' in window)) {
                alert('مرورگر شما از نوتیفیکیشن پشتیبانی نمی‌کند.');
                return;
            }
            if (Notification.permission !== 'granted') {
                Notification.requestPermission().then(perm => {
                    if (perm === 'granted') sendNotification(1);
                });
            } else {
                sendNotification(1);
            }
        };
    
        /* expose for inline onclick */
        window.playAlarm = playAlarm;
    
        /* ─── Helpers ─── */
        function getMaxOrderId() {
            let maxId = 0;
            document.querySelectorAll('#orders-tbody tr[data-order-id]').forEach(row => {
                const id = parseInt(row.dataset.orderId, 10);
                if (id > maxId) maxId = id;
            });
            return maxId;
        }
    
        function renumberRows() {
            document.querySelectorAll('#orders-tbody tr[data-order-id]').forEach((row, index) => {
                const numCell = row.querySelector('td[data-label="#"]');
                if (numCell) numCell.textContent = index + 1;
            });
        }
    
        const STATUS_LABELS = {
            pending:   'درحال پردازش',
            preparing: 'آماده‌سازی',
            sent:      'ارسال شده',
            delivered: 'تحویل داده شد',
            canceled:  'لغو شده',
        };
    
        const STATUS_COLORS = {
            pending:   '#f59e0b',
            preparing: '#3b82f6',
            sent:      '#8b5cf6',
            delivered: '#10b981',
            canceled:  '#ef4444',
        };
    
        const PAYMENT_LABELS = {
            online: '💳 پرداخت آنلاین',
            cash:   '💵 پرداخت در محل',
        };
    
        function buildPaymentStatusHtml(order) {
            if (order.payment_method === 'cash') {
                return `<span style="background:#dbeafe;color:#1d4ed8;padding:4px 8px;border-radius:6px;">پرداخت در محل</span>`;
            }
            if (order.payment_status === 'success') {
                return `<span style="background:#dcfce7;color:#166534;padding:4px 8px;border-radius:6px;">پرداخت موفق</span>`;
            }
            if (order.payment_status === 'pending') {
                return `<span style="background:#fef3c7;color:#92400e;padding:4px 8px;border-radius:6px;">در انتظار پرداخت</span>`;
            }
            if (order.payment_status === 'failed') {
                return `<span style="background:#fee2e2;color:#991b1b;padding:4px 8px;border-radius:6px;">پرداخت ناموفق</span>`;
            }
            return `<span style="background:#f3f4f6;color:#6b7280;padding:4px 8px;border-radius:6px;">نامشخص</span>`;
        }
    
        /* ═══════════════════════════════════════════
           buildRow — دقیقاً ۱۳ ستون مطابق thead
           ═══════════════════════════════════════════ */
        function buildRow(order) {
            const statusColor  = STATUS_COLORS[order.status] || '#6b7280';
            const paymentLabel = PAYMENT_LABELS[order.payment_method] || '-';
    
            const itemsHtml = (order.items && order.items.length)
                ? `<ul class="order-items">${order.items.map(i => `
                    <li>
                        <span class="item-name">${i.name}</span>
                        <span class="item-detail">${i.quantity} عدد <span style="margin:0 4px">•</span> ${Number(i.price).toLocaleString('fa-IR')} تومان</span>
                    </li>`).join('')}
                  </ul>`
                : '<span class="text-muted">-</span>';
    
            const statusOptions = Object.entries(STATUS_LABELS).map(([val, label]) =>
                `<option value="${val}" ${order.status === val ? 'selected' : ''}>${label}</option>`
            ).join('');
    
            const paymentStatusHtml = buildPaymentStatusHtml(order);
    
            const noteHtml = order.note
                ? `<div style="max-width:250px; white-space:pre-wrap;">${order.note}</div>`
                : `<span style="color:#9ca3af;">-</span>`;
    
            return `
            <tr class="new-order-row" data-order-id="${order.id}">
                <td data-label="#"></td>
                <td data-label="شماره سفارش"><span style="font-family:sans-serif;font-weight:bold;">${order.id}</span></td>
                <td data-label="شماره تماس">${order.phone ?? '-'}</td>
                <td data-label="آدرس"><span style="max-width:200px;display:block;overflow:hidden;text-overflow:ellipsis;">${order.address ?? '-'}</span></td>
                <td data-label="آیتم‌ها">${itemsHtml}</td>
                <td data-label="تعداد کل">${order.total_quantity}</td>
                <td data-label="جمع کل"><strong style="color:var(--primary-color);">${Number(order.total_price).toLocaleString('fa-IR')} <span style="font-size:0.8em">تومان</span></strong></td>
                <td data-label="وضعیت">
                    <form action="${order.update_url}" method="POST" style="display:flex;align-items:center;gap:5px;">
                        <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                        <input type="hidden" name="_method" value="PATCH">
                        <div style="display:flex;align-items:center;background:#f3f4f6;padding:4px;border-radius:8px;border:1px solid #e5e7eb;">
                            <span style="width:10px;height:10px;border-radius:50%;background-color:${statusColor};display:inline-block;margin-left:5px;"></span>
                            <select name="status" onchange="this.form.submit()" style="border:none;background:transparent;padding:2px;font-size:0.9em;cursor:pointer;outline:none;">
                                ${statusOptions}
                            </select>
                        </div>
                    </form>
                </td>
                <td data-label="روش پرداخت">${paymentLabel}</td>
                <td data-label="وضعیت پرداخت">${paymentStatusHtml}</td>
                <td data-label="تاریخ"><small>${order.created_at}</small></td>
                <td data-label="توضیحات مشتری">${noteHtml}</td>
                <td data-label="چاپ">
                    <a href="${order.print_url}" target="_blank"
                       style="display:inline-flex;align-items:center;justify-content:center;padding:6px 10px;background:#111827;color:#fff;text-decoration:none;border-radius:8px;font-size:13px;font-weight:600;">
                        🖨 چاپ
                    </a>
                </td>
            </tr>`;
        }
    
        /* ─── Polling ─── */
        async function pollOrders() {
            try {
                const res = await fetch(`${POLL_URL}?last_id=${lastKnownId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    }
                });
    
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
    
                const data = await res.json();
    
                if (data.orders && data.orders.length > 0) {
                    const tbody    = document.getElementById('orders-tbody');
                    const emptyRow = document.getElementById('empty-row');
    
                    if (emptyRow) emptyRow.remove();
    
                    data.orders.forEach(order => {
                        if (order.id > lastKnownId) lastKnownId = order.id;
                        tbody.insertAdjacentHTML('afterbegin', buildRow(order));
                    });
    
                    renumberRows();
    
                    playAlarm();
                    sendNotification(data.orders.length);
    
                    document.title = `(${data.orders.length} سفارش جدید) لیست سفارشات`;
                    setTimeout(() => { document.title = 'لیست سفارشات'; }, 5000);
                }
    
                const liveStatus = document.getElementById('live-status');
                if (liveStatus) liveStatus.textContent = 'آنلاین - بروزرسانی خودکار';
    
            } catch (err) {
                console.error('Polling error:', err);
                const liveStatus = document.getElementById('live-status');
                if (liveStatus) liveStatus.textContent = 'خطا در اتصال - تلاش مجدد...';
            }
        }
    
        requestNotificationPermission();
        setInterval(pollOrders, POLL_INTERVAL);
    
    })();
    </script>

@endsection