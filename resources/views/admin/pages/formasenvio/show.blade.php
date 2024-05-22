@extends('adminlte::page')

@section('title', "Detalhes da Forma de Envio { $formaEnvio->nome }")

@section('content_header')
<h1>Detalhes da Forma de Envio <b>{{ $formaEnvio->nome }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <ul>
                <li><strong>Nome:</strong>{{ $formaEnvio->nome }}</li>
                <li><strong>Valor:</strong>{{ number_format($formaEnvio->valor, 2, ',', '.') }}</li>
            </ul>
            
            <form action="{{ route('formasenvio.destroy', $formaEnvio->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR A FORMA DE ENVIO {{ $formaEnvio->nome }}</button>
            </form>
            
        </div>
    </div>
@stop