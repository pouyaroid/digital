<?php

namespace App\Http\Controllers;

use App\Models\ContactSection;
use Illuminate\Http\Request;

class ContactSectionController extends Controller
{
    // نمایش در فرانت
    public function show()
    {
        $contact = ContactSection::first();
        return view('contact.show', compact('contact'));
    }

    // فرم ویرایش (ادمین)
    public function edit()
    {
        $contact = ContactSection::first();
        return view('admin.contact.edit', compact('contact'));
    }

    // ذخیره تغییرات
    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'instagram_label' => 'nullable|string|max:255',
            'telegram_url' => 'nullable|string|max:255',
            'telegram_label' => 'nullable|string|max:255',
        ]);
    
        $contact = ContactSection::first();
    
        if (!$contact) {
            // اگر وجود نداشت → بساز
            $contact = ContactSection::create($request->all());
        } else {
            // اگر وجود داشت → آپدیت کن
            $contact->update($request->all());
        }
    
        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد');
    }
}    