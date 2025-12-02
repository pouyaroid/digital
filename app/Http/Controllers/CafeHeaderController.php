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
        ]);

        // اگر از قبل هدر وجود داشت، اجازه ساخت دوباره نده
        if (CafeHeader::exists()) {
            return back()->with('error', 'هدر از قبل وجود دارد، فقط می‌توانید ویرایش کنید.');
        }

        CafeHeader::create($request->all());

        return back()->with('success', 'هدر با موفقیت ایجاد شد');
    }

    // ویرایش هدر (update)
    public function update(Request $request)
    {
        $request->validate([
            'cafe_name' => 'required|string|max:255',
            'cafe_tagline' => 'nullable|string|max:255',
            'coffee_emoji' => 'nullable|string|max:10',
        ]);

        $header = CafeHeader::first() ?? new CafeHeader();
        $header->fill($request->all());
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
