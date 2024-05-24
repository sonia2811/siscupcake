@extends('site.layouts.app')

@section('content')

    <div class="text-center">
        <h1 class="title-plan">CARDÁPIO</h1>
    </div>
    <hr>
    <div class="row">
        @foreach($products as $product)
        
        
        
        
        
            <div class="col s12 m6 l4">
                    <div class="card medium">
                            <div class="card-image">
                                <img src="{{ url("storage/{$product->foto}") }}" alt="{{ $product->nome }}"  style="max-width: 90px;" />
                            </div>
                            <div class="card-content">
                                    <span class="card-title grey-text text-darken-4 truncate" title="{{ $product->nome }}">{{ $product->nome }}</span>
                                    <p>R$ {{ number_format($product->valor, 2, ',', '.') }}</p>
                            </div>
                            <div class="card-action">
                                    <a class="blue-text" href="#">Veja mais informações</a>
                            </div>
                    </div>
            </div>
        
        
        
        
        
        
        
        
<!--            <div class="col-md-4 col-sm-6">
                <div class="pricingTable">
                    <div class="pricing-content">
                        <div class="pricingTable-header">
                            <h3 class="title">{{ $product->nome }}</h3>
                        </div>
                        <div class="inner-content">
                            <div>
                                <img src="{{ url("storage/{$product->foto}") }}" alt="{{ $product->nome }}"  style="max-width: 90px;" />
                            </div>
                            <div class="price-value">
                                <span class="currency">R$</span>
                                <span class="amount">{{ number_format($product->valor, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="pricingTable-signup">
                        <a href="#">Adicionar no Carrinho</a>
                    </div>
                </div>
            </div>-->
        @endforeach
    </div>
<!--    <div>
        <table>
            <thead>
                <th></th>
                <th>Produto</th>
                <th>Preço</th>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td><img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}"  style="max-width: 90px;" /></td>
                        <td>{{ $product->title }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>-->
@stop