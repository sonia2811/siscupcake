<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    
    private $repository;
    
    public function __construct(Product $product) {
        $this->repository = $product;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();
        
        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $data = $request->all();
        
        if ($request->hasFile('foto') && $request->foto->isValid()){
            $data['foto'] = $request->foto->store("products");
        }
        
        $this->repository->create($data);
            
        return redirect()->route('products.index')
                ->with('message', 'Registro cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->repository->find($id);
        
        if (!$product){
            return redirect()->back();
        }
        
        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->repository->find($id);
        
        if (!$product){
            return redirect()->back();
        }
        
        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
        
        $product = $this->repository->find($id);
        
        if (!$product){
            return redirect()->back();
        }
        
        $data = $request->all();
        $tenant = auth()->user()->tenant;
        
        if ($request->hasFile('foto') && $request->image->isValid()){
            if (Storage::exists($product->foto)){
                Storage::delete($product->foto);
            }
            
            $data['image'] = $request->image->store("tenants\{$tenant->uuid}\products");
        }
        
        $product->update($data);
        
        return redirect()->route('products.index')
                ->with('message', 'Registro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->repository->find($id);
        
        if (!$product){
            return redirect()->back();
        }
        
        if (Storage::exists($product->foto)){
            Storage::delete($product->foto);
        }
        
        $product->delete();
        
        return redirect()->route('products.index')
                ->with('message', 'Registro excluído com sucesso.');
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $products = $this->repository->search($request->filter);
        
        return view('admin.pages.products.index', compact('products', 'filters'));
        
    }
}
