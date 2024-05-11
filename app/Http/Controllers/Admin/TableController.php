<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Http\Requests\StoreUpdateTableRequest;

class TableController extends Controller
{
    private $repository;
    
    public function __construct(Table $table) {
        $this->repository = $table;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->latest()->paginate();
        
        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTableRequest $request)
    {
        $data = $request->all();
        
        $data['tenant_id'] = auth()->user()->tenant_id;
        
        $this->repository->create($data);
            
        return redirect()->route('tables.index')
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
        $table = $this->repository->find($id);
        
        if (!$table){
            return redirect()->back();
        }
        
        return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = $this->repository->find($id);
        
        if (!$table){
            return redirect()->back();
        }
        
        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTableRequest $request, $id)
    {
        $table = $this->repository->find($id);
        
        if (!$table){
            return redirect()->back();
        }
        
        $table->update($request->all());
        
        return redirect()->route('tables.index')
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
        $table = $this->repository->find($id);
        
        if (!$table){
            return redirect()->back();
        }
        
        $table->delete();
        
        return redirect()->route('tables.index')
                ->with('message', 'Registro excluído com sucesso.');
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $tables = $this->repository->search($request->filter);
        
        return view('admin.pages.tables.index', compact('tables', 'filters'));
        
    }
}
