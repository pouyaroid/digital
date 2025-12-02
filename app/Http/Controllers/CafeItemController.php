<?php

namespace App\Http\Controllers;

use App\Models\CafeItem;
use App\Models\CafeCategory;
use Illuminate\Http\Request;

class CafeItemController extends Controller
{
    public function index()
    {
        $items = CafeItem::with('category')->orderBy('order')->get();
        $categories = CafeCategory::orderBy('order')->get();

        return view('admin.cafe.items.index', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => 'required|exists:cafe_categories,id',
            'name'           => 'required|string|max:255',
            'price'          => 'required|integer',
            'discount_price' => 'nullable|integer',
            'description'    => 'nullable',
            'tags'           => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,png,jpeg',
            'calories'       => 'nullable|integer',
            'order'          => 'integer',
            'is_available'   => 'boolean'
        ]);

        $data = $request->all();

        // آپلود عکس
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cafe/items', 'public');
        }

        CafeItem::create($data);

        return back()->with('success', 'آیتم با موفقیت اضافه شد');
    }
}
