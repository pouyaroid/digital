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
            $settings = MenuSetting::create();
        }

        return view('admin.menu_settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = MenuSetting::first();

        $settings->update([
            'ordering_enabled' => $request->has('ordering_enabled'),
            'show_prices'      => $request->has('show_prices'),
            'show_calories'    => $request->has('show_calories'),
            'theme_color'      => $request->theme_color,
        ]);

        return back()->with('success', 'تنظیمات منو ذخیره شد');
    }
}