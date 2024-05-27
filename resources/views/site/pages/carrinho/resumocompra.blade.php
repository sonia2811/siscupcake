@extends('site.layouts.app')
@section('pagina_titulo', 'RESUMO DA COMPRA' )

@section('content')

<div class="container">
    <div class="row">
        <h3>Resumo da Compra</h3>
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
                                    <span class="col l4 m4 s4"> {{ $itemCarrinhoCompra->quantidade }} </span>
                                </div>
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
                <form method="POST" action="{{ route('venda.concluir') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <strong class="col s4 m4 l3 offset-l4 right-align">Forma de Pagamento: </strong>
                        <select name="formapagamento" class="col s6 m6 l3">
                            <option value="" disabled="" selected="">Seleciona pagamento...</option>
                            @foreach($formasPagamento as $formaPagamento)
                                <option value="{{ $formaPagamento->id }}">{{ $formaPagamento->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <strong class="col s4 m4 l3 offset-l4 right-align">Forma de Envio: </strong>
                        <select name="formaenvio" class="col s6 m6 l3">
                            <option value="" disabled="" selected="">Seleciona envio...</option>
                            @foreach($formasEnvio as $formaEnvio)
                                <option value="{{ $formaEnvio->id }}">{{ $formaEnvio->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="pedido_id" value="{{ $carrinhoCompra->id }}">
                    <button type="submit" class="btn-large blue col offset-l1 offset-s1 offset-m1 l5 s5 m5 tooltipped" data-position="top" data-delay="50" data-tooltip="Adquirir os produtos concluindo a compra?">
                        Concluir Compra
                    </button>   
                </form>
            </div>
        @empty
            <h5>Não há nenhum pedido no carrinho</h5>
        @endforelse
    </div>
</div>

@endsection