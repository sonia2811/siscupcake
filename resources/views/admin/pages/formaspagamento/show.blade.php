@extends('adminlte::page')

@section('title', "Detalhes da Forma de Pagamento { $formaPagamento->name }")

@section('content_header')
<h1>Detalhes da Forma de Pagamento <b>{{ $formaPagamento->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <ul>
                <li><strong>Nome:</strong>{{ $formaPagamento->nome }}</li>
                <li><strong>Descrição:</strong>{{ $formaPagamento->descricao }}</li>
            </ul>
            
            <form action="{{ route('formaspagamento.destroy', $formaPagamento->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR A FORMA DE PAGAMENTO {{ $formaPagamento->nome }}</button>
            </form>
            
        </div>
    </div>
@stop