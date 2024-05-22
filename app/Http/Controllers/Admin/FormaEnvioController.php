<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateFormaEnvioRequest;
use App\Models\FormaEnvio;

class FormaEnvioController extends Controller
{
    
    private $repository;
    
    public function __construct(FormaEnvio $formaEnvio) {
        $this->repository = $formaEnvio;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formasEnvio = $this->repository->latest()->paginate();
        
        return view('admin.pages.formasenvio.index', compact('formasEnvio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.formasenvio.create');
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
            
        return redirect()->route('formasenvio.index')
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
        $formaEnvio = $this->repository->find($id);
        
        if (!$formaEnvio){
            return redirect()->back();
        }
        
        return view('admin.pages.formasenvio.show', compact('formaEnvio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formaEnvio = $this->repository->find($id);
        
        if (!$formaEnvio){
            return redirect()->back();
        }
        
        return view('admin.pages.formasenvio.edit', compact('formaEnvio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFormaEnvioRequest $request, $id)
    {
        $formaEnvio = $this->repository->find($id);
        
        if (!$formaEnvio){
            return redirect()->back();
        }
        
        $data = $request->all();
        
        $formaEnvio->update($data);
        
        return redirect()->route('formasenvio.index')
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
        $formaEnvio = $this->repository->find($id);
        
        if (!$formaEnvio){
            return redirect()->back();
        }
        
        $formaEnvio->delete();
        
        return redirect()->route('formasenvio.index')
                ->with('message', 'Registro excluído com sucesso.');
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $formasEnvio = $this->repository->search($request->filter);
        
        return view('admin.pages.formasenvio.index', compact('formasEnvio', 'filters'));
        
    }
}
