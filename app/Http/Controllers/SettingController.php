<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\CafeHeader;
use EragLaravelPwa\Services\PWAService;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request, PWAService $pwa)
    {
        foreach ($request->except('_token') as $key => $value) {
    
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    
        $header = CafeHeader::first();
    
        $manifest = [
    
            'name' => $header->cafe_name ?? config('app.name'),
    
            'short_name' => Setting::get('pwa_short_name', 'Cafe'),
    
            'start_url' => Setting::get('pwa_start_url', '/'),
    
            'background_color' => Setting::get(
                'pwa_background_color',
                '#ffffff'
            ),
    
            'description' => Setting::get(
                'pwa_description',
                $header->cafe_tagline ?? ''
            ),
    
            'display' => Setting::get(
                'pwa_display',
                'standalone'
            ),
    
            'theme_color' => Setting::get(
                'pwa_theme_color',
                '#FF5722'
            ),
    
            'icons' => [
    
                [
    
                    'src' => $header && $header->logo
                        ? 'storage/'.$header->logo
                        : 'logo.png',
    
                    'sizes' => '512x512',
    
                    'type' => 'image/png',
    
                ],
    
            ],
    
        ];
    
        $pwa->update($manifest);
    
        return back()->with('success', 'تنظیمات با موفقیت ذخیره شد.');
    }
    public function pwa()
    {
        return view('admin.settings.pwa');
    }
}
