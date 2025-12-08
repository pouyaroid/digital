<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب کاربری | کافه رستوران</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* استایل‌های سفارشی برای افکت‌های نئونی و شیشه‌ای */
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #0c0a5b 50%, #0f3460 100%);
            min-height: 100vh;
        }
        
        .glass-morphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        
        .neon-glow {
            text-shadow: 
                0 0 5px #626060,
                0 0 10px #fff,
                0 0 20px #7474ff,
                0 0 40px #7474ff,
                0 0 80px #7474ff;
        }
        
        .neon-border {
            border: 2px solid #ff00de;
            box-shadow: 
                0 0 5px #ff00de,
                inset 0 0 5px #ff00de,
                0 0 10px #ff00de,
                inset 0 0 10px #ff00de;
        }
        
        .neon-button {
            background: linear-gradient(45deg, #9e95ff, #1b0eaa);
            box-shadow: 
                0 0 5px #9e95ff,
                0 0 10px #9e95ff,
                0 0 15px #9e95ff;
            transition: all 0.3s ease;
        }
        
        .neon-button:hover {
            box-shadow: 
                0 0 10px #9e95ff,
                0 0 20px #9e95ff,
                0 0 30px #9e95ff;
            transform: translateY(-2px);
        }
        
        .input-neon:focus {
            outline: none;
            border-color: #00d9ff;
            box-shadow: 
                0 0 5px #00d9ff,
                0 0 10px #00d9ff,
                0 0 15px #00d9ff;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">
    <div class="glass-morphism rounded-2xl p-8 w-full max-w-md">
        <!-- هدر فرم -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full neon-border mb-4 floating">
                <i class="fas fa-coffee text-4xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white neon-glow mb-2">ورود به حساب کاربری</h1>
            <p class="text-gray-300">به کافه رستوران ما خوش آمدید!</p>
        </div>

        <!-- فرم لاگین -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <!-- ایمیل -->
            <div>
                <label for="email" class="block text-gray-300 mb-2">
                    <i class="fas fa-envelope ml-2"></i> ایمیل
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required
                    class="input-neon w-full px-4 py-3 rounded-lg bg-gray-800 bg-opacity-50 text-white border border-gray-600 focus:border-blue-400 transition"
                    placeholder="example@email.com"
                >
                @error('email')
                    <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- رمز عبور -->
            <div>
                <label for="password" class="block text-gray-300 mb-2">
                    <i class="fas fa-lock ml-2"></i> رمز عبور
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required
                    class="input-neon w-full px-4 py-3 rounded-lg bg-gray-800 bg-opacity-50 text-white border border-gray-600 focus:border-blue-400 transition"
                    placeholder="••••••••"
                >
                @error('password')
                    <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- گزینه‌های اضافی -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-gray-300">
                    <input type="checkbox" name="remember" class="rounded text-blue-500 focus:ring-blue-400">
                    <span class="mr-2">مرا به خاطر بسپار</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-400 hover:text-blue-300 transition">
                        فراموشی رمز عبور؟
                    </a>
                @endif
            </div>

            <!-- دکمه ورود -->
            <div>
                <button type="submit" class="neon-button w-full py-3 rounded-lg text-white font-bold text-lg">
                    <i class="fas fa-sign-in-alt ml-2"></i> ورود به حساب
                </button>
            </div>
        </form>

        <!-- لینک ثبت‌نام -->
        <div class="mt-6 text-center">
            <p class="text-gray-400">
                حساب کاربری ندارید؟
                <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 transition font-medium">
                    ثبت‌نام کنید
                </a>
            </p>
        </div>
    </div>

    <!-- المان‌های تزئینی نئونی -->
    <div class="fixed top-10 left-10 w-20 h-20 rounded-full bg-pink-500 opacity-20 blur-xl"></div>
    <div class="fixed bottom-20 right-10 w-32 h-32 rounded-full bg-blue-500 opacity-20 blur-xl"></div>
    <div class="fixed top-1/3 right-1/4 w-16 h-16 rounded-full bg-purple-500 opacity-20 blur-xl"></div>
</body>
</html>