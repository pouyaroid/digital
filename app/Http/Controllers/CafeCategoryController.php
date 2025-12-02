<?php

namespace App\Http\Controllers;

use App\Models\CafeCategory;
use Illuminate\Http\Request;

class CafeCategoryController extends Controller
{
    public function index()
    {
        $categories = CafeCategory::orderBy('order')->get();
        return view('admin.cafe.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'icon'  => 'nullable|string',
            'order' => 'integer'
        ]);

        CafeCategory::create($request->all());

        return back()->with('success', 'دسته‌بندی جدید اضافه شد');
    }
}
