@extends('adminlte::page')

@section('title', "Detalhes do Cupom de Desconto { $cupomDesconto->name }")

@section('content_header')
<h1>Detalhes do Cupom de Desconto <b>{{ $cupomDesconto->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <ul>
                <li><strong>Nome:</strong>{{ $cupomDesconto->nome }}</li>
                <li><strong>Localizador:</strong>{{ $cupomDesconto->localizador }}</li>
                <li><strong>Desconto:</strong>{{ $cupomDesconto->desconto }}</li>
            </ul>
            
            <form action="{{ route('cuponsdesconto.destroy', $cupomDesconto->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR O CUPOM DE DESCONTO {{ $cupomDesconto->nome }}</button>
            </form>
            
        </div>
    </div>
@stop