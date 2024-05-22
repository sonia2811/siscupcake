@extends('adminlte::page')

@section('title', "Detalhes do Produto { $product->nome }")

@section('content_header')
<h1>Detalhes do Produto <b>{{ $product->nome }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <img src="{{ url("storage/{$product->foto}") }}" alt="{{ $product->nome }}" style="max-width: 150px;">
            <ul>
                <li><strong>Nome:</strong>{{ $product->nome }}</li>
                <li><strong>Descrição:</strong>{{ $product->descricao }}</li>
            </ul>
            
            <form action="{{ route('products.destroy', $product->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR O PRODUTO {{ $product->nome }}</button>
            </form>
            
        </div>
    </div>
@stop