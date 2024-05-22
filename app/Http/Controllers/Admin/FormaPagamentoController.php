<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateFormaPagamentoRequest;
use App\Models\FormaPagamento;

class FormaPagamentoController extends Controller
{
    
    private $repository;
    
    public function __construct(FormaPagamento $formaPagamento) {
        $this->repository = $formaPagamento;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formasPagamento = $this->repository->latest()->paginate();
        
        return view('admin.pages.formaspagamento.index', compact('formasPagamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.formaspagamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $this->repository->create($data);
            
        return redirect()->route('formaspagamento.index')
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
        $formaPagamento = $this->repository->find($id);
        
        if (!$formaPagamento){
            return redirect()->back();
        }
        
        return view('admin.pages.formaspagamento.show', compact('formaPagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formaPagamento = $this->repository->find($id);
        
        if (!$formaPagamento){
            return redirect()->back();
        }
        
        return view('admin.pages.formaspagamento.edit', compact('formaPagamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFormaPagamentoRequest $request, $id)
    {
        $formaPagamento = $this->repository->find($id);
        
        if (!$formaPagamento){
            return redirect()->back();
        }
        
        $data = $request->all();
        
        $formaPagamento->update($data);
        
        return redirect()->route('formaspagamento.index')
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
        $formaPagamento = $this->repository->find($id);
        
        if (!$formaPagamento){
            return redirect()->back();
        }
        
        $formaPagamento->delete();
        
        return redirect()->route('formaspagamento.index')
                ->with('message', 'Registro excluído com sucesso.');
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $formasPagamento = $this->repository->search($request->filter);
        
        return view('admin.pages.formaspagamento.index', compact('formasPagamento', 'filters'));
        
    }
}
