<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="5;url={{ route('profile.index') }}">
<title>نتیجه پرداخت</title>

<style>
body{
    font-family:tahoma;
    background:#f8fafc;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.card{
    background:#fff;
    padding:30px;
    border-radius:15px;
    width:450px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
}
.success{
    color:#16a34a;
}
.error{
    color:#dc2626;
}
</style>
</head>
<body>

<div class="card">

@if($success)

    <h2 class="success">✅ پرداخت موفق</h2>

    <p>{{ $message }}</p>

    <h3>
        کد رهگیری:
        {{ $refId }}
    </h3>

@else

    <h2 class="error">❌ پرداخت ناموفق</h2>

    <p>{{ $message }}</p>

@endif

<p style="margin-top:20px">
تا ۵ ثانیه دیگر به پروفایل منتقل می‌شوید...
</p>

</div>

</body>
</html>