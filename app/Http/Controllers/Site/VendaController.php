<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\CarrinhoCompra;
use Carbon\Carbon;

class VendaController extends Controller
{
    
    private $repository;
    
    public function __construct(Venda $venda) {
        $this->repository = $venda;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    
    public function visualizarCompras()
    {
        
        $compras = $this->repository->where([
            'pago'  => 'S',
            'usuario_id' => Auth::id()
            ])->orderBy('created_at', 'desc')->get();

        $cancelados = $this->repository->where([
            'pago'  => 'N',
            'usuario_id' => Auth::id()
            ])->orderBy('updated_at', 'desc')->get();

        return view('site.pages.vendas.compras', compact('compras', 'cancelados'));
    }
    
    public function concluir(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

//        $req = Request();
        $idCarrinhoCompra = $request->input('pedido_id');
        $idusuario = Auth::id();

        $carrinhoCompra = CarrinhoCompra::where([
            'id'      => $idCarrinhoCompra,
            'usuario_id' => $idusuario,
            'venda_id' => null
            ])->first();

        if( empty($carrinhoCompra) ) {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }

        $itensCarrinhoCompra = $carrinhoCompra->itensCarrinhoCompra;
        
        if($itensCarrinhoCompra->count() == 0) {
            $request->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('carrinho.index');
        }

        $venda = Venda::create([
                'usuario_id' => $idusuario,
                'forma_pagamento_id' => $request->input('formapagamento'),
                'forma_envio_id' => $request->input('formaenvio'),
                'data_venda' => Carbon::now(),
            ]);
        
        foreach($itensCarrinhoCompra as $itemCarrinhoCompra){
            
            $venda->itensVenda()->create([
                'produto_id' => $itemCarrinhoCompra->produto_id,
                'quantidade' => $itemCarrinhoCompra->quantidade,
                'preco_compra' => $itemCarrinhoCompra->valor,
                'subtotal' => $itemCarrinhoCompra->subtotal,
            ]);
            
        }
        
        $carrinhoCompra->venda_id = $venda->id;
        $carrinhoCompra->save();
        
        $request->session()->flash('mensagem-sucesso', 'Compra concluída com sucesso!');

        return redirect()->route('carrinho.compras');
    }
}
