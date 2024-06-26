@extends('site.layouts.app')
@section('pagina_titulo', 'CARRINHO' )

@section('content')

<div class="container">
    <div class="row">
        <h3>Produtos no carrinho</h3>
        <hr/>
        @if (Session::has('mensagem-sucesso'))
            <div class="card-panel green">
                <strong>{{ Session::get('mensagem-sucesso') }}</strong>
            </div>
        @endif
        @if (Session::has('mensagem-falha'))
            <div class="card-panel red">
                <strong>{{ Session::get('mensagem-falha') }}</strong>
            </div>
        @endif
        @forelse ($carrinhoCompras as $carrinhoCompra)
            <h5 class="col l6 s12 m6"> Pedido: {{ $carrinhoCompra->id }} </h5>
            <h5 class="col l6 s12 m6"> Criado em: {{ $carrinhoCompra->created_at->format('d/m/Y H:i') }} </h5>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Qtd</th>
                        <th>Produto</th>
                        <th>Valor Unit.</th>
                        <th>Desconto(s)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_pedido = 0;
                    @endphp
                    @foreach ($carrinhoCompra->itensCarrinhoCompra as $itemCarrinhoCompra)

                    <tr>
                        <td>
                            <img width="100" height="100" src="{{ url("storage/{$itemCarrinhoCompra->produto->foto}") }}">
                        </td>
                        <td class="center-align">
                            <div class="center-align">
                                <a class="col l4 m4 s4" href="#" onclick="carrinhoSubtrairProduto({{ $carrinhoCompra->id }}, {{ $itemCarrinhoCompra->produto_id }}, 1 )">
                                    <i class="material-icons small">remove_circle_outline</i>
                                </a>
                                <span class="col l4 m4 s4"> {{ $itemCarrinhoCompra->quantidade }} </span>
                                <a class="col l4 m4 s4" href="#" onclick="carrinhoAdicionarProduto({{ $itemCarrinhoCompra->produto_id }})">
                                    <i class="material-icons small">add_circle_outline</i>
                                </a>
                            </div>
                            <a href="#" onclick="carrinhoRemoverProduto({{ $carrinhoCompra->id }}, {{ $itemCarrinhoCompra->produto_id }}, 0)" class="tooltipped" data-position="right" data-delay="50" data-tooltip="Retirar produto do carrinho?">Retirar produto</a>
                        </td>
                        <td> {{ $itemCarrinhoCompra->produto->nome }} </td>
                        <td>R$ {{ number_format($itemCarrinhoCompra->produto->valor, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($itemCarrinhoCompra->descontos, 2, ',', '.') }}</td>
                        @php
                            $total_produto = $itemCarrinhoCompra->valor * $itemCarrinhoCompra->quantidade;
                            $total_pedido += $total_produto;
                        @endphp
                        <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <strong class="col offset-l6 offset-m6 offset-s6 l4 m4 s4 right-align">Total do pedido: </strong>
                <span class="col l2 m2 s2">R$ {{ number_format($total_pedido, 2, ',', '.') }}</span>
            </div>
            <div class="row">
                <form method="POST" action="{{ route('carrinho.desconto') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="pedido_id" value="{{ $carrinhoCompra->id }}">
                    <strong class="col s4 m4 l3 offset-l4 right-align">Cupom de desconto: </strong>
                    <input class="col s6 m6 l3" type="text" name="cupom">
                    <button class="btn-flat btn-large col s2 m2 l2">Validar</button>
                </form>
            </div>
            <div class="row">
                <a class="btn-large tooltipped col l4 s4 m4 offset-l2 offset-s2 offset-m2" data-position="top" data-delay="50" data-tooltip="Voltar a página inicial para continuar comprando?" href="{{ route('site.home') }}">Continuar comprando</a>
                <form method="POST" action="{{ route('carrinho.visualizarresumo') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="pedido_id" value="{{ $carrinhoCompra->id }}">
                    <button type="submit" class="btn-large blue col offset-l1 offset-s1 offset-m1 l5 s5 m5 tooltipped" data-position="top" data-delay="50" data-tooltip="Adquirir os produtos concluindo a compra?">
                        Realizar Compra
                    </button>   
                </form>
            </div>
        @empty
            <h5>Não há nenhum pedido no carrinho</h5>
        @endforelse
    </div>
</div>

<form id="form-remover-produto" method="POST" action="{{ route('carrinho.remover') }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="pedido_id">
    <input type="hidden" name="produto_id">
    <input type="hidden" name="item">
</form>

<form id="form-subtrair-produto" method="POST" action="{{ route('carrinho.subtrair') }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="pedido_id">
    <input type="hidden" name="produto_id">
    <input type="hidden" name="item">
</form>

<form id="form-adicionar-produto" method="POST" action="{{ route('carrinho.adicionar') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id">
</form>

@push('scripts')
    <script type="text/javascript" src="/js/carrinho.js"></script>
@endpush

@endsection