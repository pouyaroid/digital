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
    public function destroy($id){
        $cafe=CafeItem::find($id);
        $cafe->delete();
        return redirect()->route('admin.cafe.items.index');

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id'    => 'required|exists:cafe_categories,id',
            'name'           => 'required|string|max:255',
            'price'          => 'required|integer',
            'discount_price' => 'nullable|integer',
            'description'    => 'nullable|string',
            'tags'           => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,png,jpeg',
            'calories'       => 'nullable|integer',
            'order'          => 'nullable|integer',
            'is_available'   => 'nullable|boolean'
        ]);
    
        $item = CafeItem::findOrFail($id);
    
        $data = $request->only([
            'category_id',
            'name',
            'price',
            'discount_price',
            'description',
            'tags',
            'calories',
            'order'
        ]);
    
        $data['is_available'] = $request->boolean('is_available');
    
        // اگر عکس جدید آپلود شد
        if ($request->hasFile('image')) {
    
            // حذف عکس قبلی
            if ($item->image) {
                \Storage::disk('public')->delete($item->image);
            }
    
            $data['image'] = $request->file('image')
                ->store('cafe/items', 'public');
        }
    
        $item->update($data);
    
        return back()->with('success', 'آیتم با موفقیت ویرایش شد');
    }
    public function edit($id){
        $item=CafeItem::findOrFail($id);
        $categories = CafeCategory::orderBy('order')->get();
        return view('admin.cafe.items.edit', compact('item', 'categories'));



    }
    
    }
    
