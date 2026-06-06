<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Otp;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneAuthController extends Controller
{
    // نمایش فرم شماره موبایل
    public function showPhoneForm()
    {
        return view('auth.phone');
    }

    // ارسال OTP
    public function sendOtp(Request $request, SmsService $smsService)
    {
        $request->validate([
            'phone' => 'required'
        ]);

        // جلوگیری از اسپم
        $lastOtp = Otp::where('phone', $request->phone)
            ->where('created_at', '>=', now()->subMinute())
            ->first();

        if ($lastOtp) {
            return back()->withErrors(['phone' => 'لطفاً 1 دقیقه صبر کنید']);
        }

        $code = rand(10000, 99999);

        // حذف OTP قبلی
        Otp::where('phone', $request->phone)->delete();

        // ذخیره OTP جدید
        Otp::create([
            'phone' => $request->phone,
            'code' => $code,
            'expires_at' => now()->addMinutes(5),
        ]);

        // ارسال SMS
        $smsService->sendWithTemplate(
            $request->phone,
            env('SMSIR_TEMPLATE_ID'),
            [
                [
                    "name" => "Code",
                    "value" => $code
                ]
            ]
        );

        return redirect()->route('otp.form', [
            'phone' => $request->phone
        ]);
    }

    // نمایش فرم OTP
    public function showOtpForm(Request $request)
    {
        return view('auth.otp', [
            'phone' => $request->phone
        ]);
    }

    // تایید OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'code' => 'required'
        ]);

        $otp = Otp::where('phone', $request->phone)
            ->where('code', $request->code)
            ->where('expires_at', '>=', now())
            ->first();

        if (!$otp) {
            return back()->withErrors(['code' => 'کد اشتباه یا منقضی شده']);
        }

        $otp->delete();

        $customer = Customer::firstOrCreate(
            ['phone' => $request->phone],
            [
                'name' => 'مشتری ' . substr($request->phone, -4)
            ]
        );
        
       

        Auth::guard('customer')->login($customer);

        return redirect()->route('home');
    }
}