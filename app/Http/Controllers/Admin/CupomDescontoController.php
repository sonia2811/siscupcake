<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateCupomDescontoRequest;
use App\Models\CupomDesconto;

class CupomDescontoController extends Controller
{
    
    private $repository;
    
    public function __construct(CupomDesconto $cupomDesconto) {
        $this->repository = $cupomDesconto;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuponsDesconto = $this->repository->latest()->paginate();
        
        return view('admin.pages.cuponsdesconto.index', compact('cuponsDesconto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.cuponsdesconto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCupomDescontoRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);
            
        return redirect()->route('cuponsdesconto.index')
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
        $cupomDesconto = $this->repository->find($id);
        
        if (!$cupomDesconto){
            return redirect()->back();
        }
        
        return view('admin.pages.cuponsdesconto.show', compact('cupomDesconto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cupomDesconto = $this->repository->find($id);
        
        if (!$cupomDesconto){
            return redirect()->back();
        }
        
        return view('admin.pages.cuponsdesconto.edit', compact('cupomDesconto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCupomDescontoRequest $request, $id)
    {
        $cupomDesconto = $this->repository->find($id);
        
        if (!$cupomDesconto){
            return redirect()->back();
        }
        
        $cupomDesconto->update($request->all());
        
        return redirect()->route('cuponsdesconto.index')
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
        $cupomDesconto = $this->repository->find($id);
        
        if (!$cupomDesconto){
            return redirect()->back();
        }
        
        $cupomDesconto->delete();
        
        return redirect()->route('cuponsdesconto.index')
                ->with('message', 'Registro excluído com sucesso.');
    }
}
