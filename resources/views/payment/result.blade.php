<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتیجه پرداخت</title>
    
    <!-- رفرش خودکار به صفحه پروفایل بعد از 5 ثانیه -->
    <meta http-equiv="refresh" content="5;url={{ route('profile.index') }}">

    <!-- فونت وزیرمتن -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    
    <!-- آیکون‌های RemixIcon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
            --success-color: #00a83e;
            --danger-color: #ef394e;
            --bg-color: #f7f8fa;
            --text-dark: #2c3e50;
            --text-gray: #7e8b99;
            --card-bg: #ffffff;
        }

        * {
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 420px;
        }

        .card {
            background: var(--card-bg);
            padding: 40px 30px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0,0,0,0.02);
            animation: slideUp 0.5s ease-out;
        }

        /* آیکون وضعیت */
        .status-icon {
            font-size: 80px;
            margin-bottom: 20px;
            display: inline-block;
            animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .status-icon.success { color: var(--success-color); }
        .status-icon.error { color: var(--danger-color); }

        h2 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0 0 10px 0;
            color: var(--text-dark);
        }

        p.message {
            font-size: 0.95rem;
            color: var(--text-gray);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        /* باکس کد رهگیری */
        .ref-box {
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        .ref-box.error-style {
            background: #fef2f2;
            border-color: #fee2e2;
        }

        .ref-label {
            display: block;
            font-size: 0.8rem;
            color: var(--success-color);
            margin-bottom: 5px;
            font-weight: 600;
        }
        .error-style .ref-label { color: var(--danger-color); }

        .ref-code {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: 1px;
            font-family: 'Tahoma', sans-serif; /* برای اعداد انگلیسی بهتر */
            direction: ltr;
        }

        /* دکمه و متن انتقال */
        .redirect-info {
            font-size: 0.85rem;
            color: var(--text-gray);
            border-top: 1px solid var(--bg-color);
            padding-top: 20px;
            margin-top: 20px;
        }

        .btn-home {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            background: var(--text-dark);
            color: #fff;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: 0.2s;
        }
        .btn-home:hover { background: #000; transform: translateY(-2px); }

        /* انیمیشن‌ها */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes popIn {
            from { opacity: 0; transform: scale(0.5); }
            to { opacity: 1; transform: scale(1); }
        }

    </style>
</head>
<body>

<div class="container">
    <div class="card">

        @if($success)

            {{-- حالت موفق --}}
            <div class="status-icon success">
                <i class="ri-checkbox-circle-fill"></i>
            </div>

            <h2>پرداخت موفقیت‌آمیز</h2>

            <p class="message">
                {{ $message ?? 'سفارش شما با موفقیت ثبت شد و به زودی توسط پیک ارسال می‌شود.' }}
            </p>

            <div class="ref-box">
                <span class="ref-label">کد رهگیری تراکنش</span>
                <div class="ref-code">{{ $refId }}</div>
            </div>

        @else

            {{-- حالت ناموفق --}}
            <div class="status-icon error">
                <i class="ri-close-circle-fill"></i>
            </div>

            <h2>پرداخت ناموفق</h2>

            <p class="message">
                {{ $message ?? 'متاسفانه پرداخت شما با مشکل مواجه شد. در صورت کسر مبلغ، تا ۲۴ ساعت آینده به حساب شما بازگردانده می‌شود.' }}
            </p>

            <div class="ref-box error-style" style="display: none;">
               <!-- در صورت شکست معمولا کد رهگیری معنی دار نداریم مگر بانک یک کد خطا داده باشد -->
            </div>

        @endif

        <div class="redirect-info">
            <p>تا ۵ ثانیه دیگر به پنل کاربری هدایت می‌شوید...</p>
            <a href="{{ route('profile.index') }}" class="btn-home">
                بازگشت به پنل کاربری
            </a>
        </div>

    </div>
</div>

{{-- اسکریپت شمارش معکوس (اختیاری) --}}
<script>
    let seconds = 5;
    const timerElement = document.querySelector('.redirect-info p');
    
    if(timerElement) {
        const interval = setInterval(() => {
            seconds--;
            if (seconds <= 0) {
                clearInterval(interval);
                timerElement.textContent = 'در حال انتقال...';
            } else {
                timerElement.textContent = `تا ${seconds} ثانیه دیگر به پنل کاربری هدایت می‌شوید...`;
            }
        }, 1000);
    }
</script>

</body>
</html>