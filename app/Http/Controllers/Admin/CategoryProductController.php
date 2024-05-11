<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryProductController extends Controller
{
    private $product, $category;
    
    public function __construct(Product $product, Category $category) {
        $this->product = $product;
        $this->category = $category;
    }
    
    public function categories($idProduct)
    {
        
        $product = $this->product->find($idProduct);
        
        if (!$product){
            return redirect()->back();
        }
        
        $categories = $product->categories()->paginate();
        
        return view('admin.pages.products.categories.categories', compact('product', 'categories'));
    }
    
    public function products($idCategory)
    {
        
        $category = $this->category->find($idCategory);
        
        if (!$category){
            return redirect()->back();
        }
        
        $products = $category->products()->paginate();
        
        return view('admin.pages.categories.products.products', compact('category', 'products'));
    }
    
    
    public function categoriesAvailable($idProduct)
    {
        
        if (!$product = $this->product->find($idProduct)){
            return redirect()->back();
        }
        
        $categories = $product->categoriesAvailable();
        
        return view('admin.pages.products.categories.available', compact('product', 'categories'));
    }
    
    public function filterCategoriesAvailable(Request $request, $idProduct)
    {
        $filters = $request->except('_token');
        
        if (!$product = $this->product->find($idProduct)){
            return redirect()->back();
        }
        
        $categories = $product->categoriesAvailable($request->filter);
        
        return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));
    }
    
    public function attachCategoriesProduct(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct)){
            return redirect()->back();
        }
        
        if (!$request->categories || count($request->categories) == 0){
            return redirect()->back()
                    ->with('info', 'Necessário escolher ao menos uma permissão.');
        }
        
        $product->categories()->attach($request->categories);
        
        return redirect()->route('product.categories', $idProduct);
    }
    
    public function detachCategoryProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);
        
        if (!$product || !$category){
            return redirect()->back();
        }
        
        $product->categories()->detach($category);
        
        return redirect()->route('product.categories', $product->id)
                ->with('message', 'Desvinculado com sucesso.');
    }
}
