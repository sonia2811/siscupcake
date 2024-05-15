@extends('adminlte::page')

@section('title', "Detalhes do Produto { $product->name }")

@section('content_header')
<h1>Detalhes do Produto <b>{{ $product->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width: 150px;">
            <ul>
                <li><strong>Título:</strong>{{ $product->title }}</li>
                <li><strong>Flag:</strong>{{ $product->flag }}</li>
                <li><strong>Descrição:</strong>{{ $product->description }}</li>
            </ul>
            
            <form action="{{ route('products.destroy', $product->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR O PRODUTO {{ $product->title }}</button>
            </form>
            
        </div>
    </div>
@stop