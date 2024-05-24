@extends('adminlte::page')

@section('title', 'Cupons de Desconto')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('cuponsdesconto.index') }}" class="active">Cupons de Desconto</a></li>
    </ol>

    <h1>Cupons de Desconto <a href="{{ route('cuponsdesconto.create') }}" class="btn btn-dark">ADD <i class="fas fa-plus-square"></i></a></h1>
    
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('cuponsdesconto.search') }}" method="POST" class="form form-inline">
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
                        <th>Localizador</th>
                        <th width="290">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cuponsDesconto as $cupomDesconto)
                        <tr>
                            <td>{{ $cupomDesconto->nome }}</td>
                            <td>{{ $cupomDesconto->localizador }}</td>
                            <td style="width: 10px">
                                <a href="{{ route('cuponsdesconto.edit', $cupomDesconto->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('cuponsdesconto.show', $cupomDesconto->id) }}" class="btn btn-warning">VER</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $cuponsDesconto->appends($filters)->links() !!}
            @else
                {!! $cuponsDesconto->links() !!}
            @endif
        </div>
    </div>
@stop