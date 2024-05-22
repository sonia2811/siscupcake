@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>

    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-dark">ADD <i class="fas fa-plus-square"></i></a></h1>
    
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.search') }}" method="POST" class="form form-inline">
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
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th width="290">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><img src="{{ url("storage/{$product->foto}") }}" alt="{{ $product->nome }}" style="max-width: 90px;"></td>
                            <td>{{ $product->nome }}</td>
                            <td>{{ number_format($product->valor, 2, ',', '.') }}</td>
                            <td style="width: 10px">
                                <a href="{{ route('product.categories', $product->id) }}" class="btn btn-info" title="Categorias"><i class="fas fa-layer-group"></i></a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning">VER</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
@stop