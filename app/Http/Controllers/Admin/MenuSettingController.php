<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuSetting;
use Illuminate\Http\Request;

class MenuSettingController extends Controller
{
    public function index()
    {
        $settings = MenuSetting::first();

        if (!$settings) {
            $settings = MenuSetting::create([
                'ordering_enabled' => 1,
                'show_prices'      => 1,
                'show_calories'    => 1,
                'online_payment_enabled' => 1,
                'cash_payment_enabled'   => 1,
            ]);
        }

        return view('admin.menu_settings.index', compact('settings'));
    }

    public function update(Request $request)
{
    $settings = MenuSetting::first();

    $settings->update([
        'ordering_enabled' => $request->boolean('ordering_enabled'),
        'show_prices'      => $request->boolean('show_prices'),
        'show_calories'    => $request->boolean('show_calories'),
        'theme_color'      => $request->theme_color,

        'online_payment_enabled' => $request->boolean('online_payment_enabled'),
        'cash_payment_enabled'   => $request->boolean('cash_payment_enabled'),
    ]);

    return back()->with('success', 'تنظیمات ذخیره شد');
}
}