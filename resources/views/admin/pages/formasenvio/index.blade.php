@extends('adminlte::page')

@section('title', 'Formas de Envio')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('formasenvio.index') }}" class="active">Formas de Envio</a></li>
    </ol>

    <h1>Formas de Envio <a href="{{ route('formasenvio.create') }}" class="btn btn-dark">ADD <i class="fas fa-plus-square"></i></a></h1>
    
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('formasenvio.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter '] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar <i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th width="290">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formasEnvio as $formaEnvio)
                        <tr>
                            <td>{{ $formaEnvio->nome }}</td>
                            <td>{{ number_format($formaEnvio->valor, 2, ',', '.') }}</td>
                            <td style="width: 10px">
                                <a href="{{ route('formasenvio.edit', $formaEnvio->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('formasenvio.show', $formaEnvio->id) }}" class="btn btn-warning">VER</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $formasEnvio->appends($filters)->links() !!}
            @else
                {!! $formasEnvio->links() !!}
            @endif
        </div>
    </div>
@stop