<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        
        $qtdUsuarios = User::count();
        
        $qtdProdutos = Product::count();
        
        return view('admin.pages.home.index', compact('qtdUsuarios', 'qtdProdutos'));
    }
}
