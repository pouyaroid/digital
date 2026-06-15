<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

<meta charset="UTF-8">

<title>فیش سفارش</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    width:80mm;
    margin:auto;
    font-family:tahoma;
    font-size:12px;
    padding:5px;
}

.center{
    text-align:center;
}

.header{
    margin-bottom:10px;
}

.header h2{
    font-size:18px;
}

hr{
    border:none;
    border-top:1px dashed #000;
    margin:8px 0;
}

.row{
    margin:4px 0;
}

table{
    width:100%;
    border-collapse:collapse;
}

table td{
    padding:4px 0;
}

.total{
    font-weight:bold;
    font-size:14px;
}

.footer{
    text-align:center;
    margin-top:10px;
}

@media print {

    @page {
        size: 80mm auto;
        margin:0;
    }

    .no-print{
        display:none;
    }
}

</style>

</head>

<body onload="window.print()">

<div class="header center">

    <h2>🍔 رستوران من</h2>

    <div>
        سفارش شماره:
        {{ $order->id }}
    </div>

</div>

<hr>

<div class="row">
    <strong>نام مشتری:</strong>
    {{ $order->customer->name ?? '-' }}
</div>

<div class="row">
    <strong>شماره تماس:</strong>
    {{ $order->customer->phone ?? '-' }}
</div>

<div class="row">
    <strong>آدرس:</strong>
    {{ $order->address->address ?? '-' }}
</div>

<hr>

<table>

@foreach($order->items as $item)

<tr>

<td>
{{ $item->cafeItem->name ?? '-' }}
</td>

<td style="text-align:left">
{{ $item->quantity }} عدد
</td>

</tr>

@endforeach

</table>

<hr>

<div class="row">
    <strong>روش پرداخت:</strong>

    @if($order->payment_method == 'online')
        پرداخت آنلاین
    @else
        پرداخت در محل
    @endif
</div>

<div class="row total">
    مبلغ کل:
    {{ number_format($order->total_price) }}
    تومان
</div>

<hr>



<div class="footer">

    {{ verta($order->created_at)->format('Y/m/d H:i') }}

</div>

</body>

</html>