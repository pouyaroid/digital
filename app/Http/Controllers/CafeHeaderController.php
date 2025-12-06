<?php

namespace App\Http\Controllers;

use App\Models\CafeHeader;
use Illuminate\Http\Request;

class CafeHeaderController extends Controller
{
    // نمایش هدر
    public function show()
    {
        $header = CafeHeader::first();
        return view('cafe.header', compact('header'));
    }

    // فرم ویرایش (ادمین)
    public function edit()
    {
        $header = CafeHeader::first();
        return view('admin.cafe-header.edit', compact('header'));
    }

    // ایجاد اولین هدر (store)
    public function store(Request $request)
{
    $request->validate([
        'cafe_name' => 'required|string|max:255',
        'cafe_tagline' => 'nullable|string|max:255',
        'coffee_emoji' => 'nullable|string|max:10',
        'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
    ]);

    if (CafeHeader::exists()) {
        return back()->with('error', 'هدر از قبل وجود دارد، فقط می‌توانید ویرایش کنید.');
    }

    $data = $request->all();

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->logo->store('cafe/logo', 'public');
    }

    CafeHeader::create($data);

    return back()->with('success', 'هدر با موفقیت ایجاد شد');
}


    // ویرایش هدر (update)
    public function update(Request $request)
    {
        $request->validate([
            'cafe_name' => 'required|string|max:255',
            'cafe_tagline' => 'nullable|string|max:255',
            'coffee_emoji' => 'nullable|string|max:10',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
    
        $header = CafeHeader::first() ?? new CafeHeader();
    
        $header->cafe_name = $request->cafe_name;
        $header->cafe_tagline = $request->cafe_tagline;
        $header->coffee_emoji = $request->coffee_emoji;
    
        if ($request->hasFile('logo')) {
            $header->logo = $request->logo->store('cafe/logo', 'public');
        }
    
        $header->save();
    
        return back()->with('success', 'هدر با موفقیت ویرایش شد');
    }

    // حذف هدر
    public function destroy()
    {
        $header = CafeHeader::first();

        if ($header) {
            $header->delete();
            return back()->with('success', 'هدر حذف شد');
        }

        return back()->with('error', 'هیچ هدر ثبت نشده است');
    }
}
