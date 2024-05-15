@extends('adminlte::page')

@section('title', 'Formas Pagamento')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('formaspagamento.index') }}" class="active">Formas Pagamento</a></li>
    </ol>

    <h1>Formas Pagamento <a href="{{ route('formaspagamento.create') }}" class="btn btn-dark">ADD <i class="fas fa-plus-square"></i></a></h1>
    
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('formaspagamento.search') }}" method="POST" class="form form-inline">
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
                        <th>Descrição</th>
                        <th width="290">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formasPagamento as $formaPagamento)
                        <tr>
                            <td>{{ $formaPagamento->nome }}</td>
                            <td>{{ $formaPagamento->descricao }}</td>
                            <td style="width: 10px">
                                <a href="{{ route('formaspagamento.edit', $formaPagamento->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('formaspagamento.show', $formaPagamento->id) }}" class="btn btn-warning">VER</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $formasPagamento->appends($filters)->links() !!}
            @else
                {!! $formasPagamento->links() !!}
            @endif
        </div>
    </div>
@stop