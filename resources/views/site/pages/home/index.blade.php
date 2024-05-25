@extends('site.layouts.app')

@section('content')
    <div class="row">
        @foreach($products as $product)
            <div class="col s12 m6 l4"  align="center">
                    <div class="card medium">
                            <div class="card-image">
                                <img src="{{ url("storage/{$product->foto}") }}" alt="{{ $product->nome }}"  style="max-width: 180px;" />
                            </div>
                            <div class="card-content">
                                    <span class="card-title grey-text text-darken-4 truncate" title="{{ $product->nome }}">{{ $product->nome }}</span>
                                    <p>R$ {{ number_format($product->valor, 2, ',', '.') }}</p>
                            </div>
                            <div class="card-action">
                                    <a class="blue-text" href="{{ route('site.detalhesproduto', $product->id) }}">Detalhes</a>
                            </div>
                    </div>
            </div>
        
        @endforeach
    </div>
@stop