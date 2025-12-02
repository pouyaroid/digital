<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CafeCategory;
use App\Models\CafeHeader;
use App\Models\CafeItem;
use App\Models\ContactSection;

class HomeController extends Controller
{
    public function index(){
        $categories = CafeCategory::orderBy('order')->get();
        $items = CafeItem::orderBy('order')->get();
        $header = CafeHeader::first();
        $contact = ContactSection::first();
        return view('index',compact('categories', 'items','header','contact'));
    }
}
