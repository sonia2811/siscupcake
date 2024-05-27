<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CarrinhoCompra;
use App\Models\Product;
use App\Models\ItemCarrinhoCompra;
use Carbon\Carbon;

class CarrinhoCompraController extends Controller
{
    
    private $repository;
    
    public function __construct(CarrinhoCompra $carrinhoCompra) {
        $this->repository = $carrinhoCompra;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carrinhoCompras = CarrinhoCompra::where([
            'usuario_id' => Auth::id()
            ])->get();

        return view('site.pages.carrinho.index', compact('carrinhoCompras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

//        $req = Request();
        $idproduto = $request->input('id');

        $produto = Product::find($idproduto);
        
        if( empty($produto->id) ) {
            $request->session()->flash('mensagem-falha', 'Produto não encontrado em nossa loja!');
            return redirect()->route('carrinho.index');
        }

        $idusuario = Auth::id();

        $carrinhoCompra = CarrinhoCompra::where('usuario_id', $idusuario)
                ->whereNotNull('venda_id')->first();

        if( empty($carrinhoCompra) ) {
            $carrinhoCompra = CarrinhoCompra::create([
                'usuario_id' => $idusuario,
                'criado_em' => Carbon::now(),
            ]);
            
            $idCarrinhoCompra = $carrinhoCompra->id;

        }

        ItemCarrinhoCompra::create([
            'carrinho_compra_id'  => $idCarrinhoCompra,
            'produto_id' => $idproduto,
            'quantidade' => 1,
            'valor'      => $produto->valor,
            'subtotal' => $produto->valor * 1
        ]);

        $request->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        return redirect()->route('carrinho.index');
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
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido           = $req->input('pedido_id');
        $idproduto          = $req->input('produto_id');
        $remove_apenas_item = (boolean)$req->input('item');
        $idusuario          = Auth::id();

        $idpedido = Pedido::consultaId([
            'id'      => $idpedido,
            'usuario_id' => $idusuario,
            'status'  => 'RE' // Reservada
            ]);

        if( empty($idpedido) ) {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }

        $where_produto = [
            'pedido_id'  => $idpedido,
            'produto_id' => $idproduto
        ];

        $produto = PedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        if( empty($produto->id) ) {
            $req->session()->flash('mensagem-falha', 'Produto não encontrado no carrinho!');
            return redirect()->route('carrinho.index');
        }

        if( $remove_apenas_item ) {
            $where_produto['id'] = $produto->id;
        }
        PedidoProduto::where($where_produto)->delete();

        $check_pedido = PedidoProduto::where([
            'pedido_id' => $produto->pedido_id
            ])->exists();

        if( !$check_pedido ) {
            Pedido::where([
                'id' => $produto->pedido_id
                ])->delete();
        }

        $req->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');

        return redirect()->route('carrinho.index');
    }
    
}
