<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SiteController extends Controller
{
    
    public function index()
    {
        $products = Product::orderBy('valor')->get();
        
        return view('site.pages.home.index', compact('products'));
    }
    
}