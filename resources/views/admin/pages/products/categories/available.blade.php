@extends('adminlte::page')

@section('title', "Categorias disponíveis para o Produto {$product->title}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product.categories', $product->id) }}" >Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('product.categories.available', $product->id) }}" class="active">Disponíveis</a></li>
    </ol>

    <h1>Categorias disponíveis para o Produto <strong>{{$product->title}}</strong></h1>
    
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('product.categories.available.search', $product->id) }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter '] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar <i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('product.categories.attach', $product->id) }}" method="POST">
                        @csrf
                        
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" >
                                </td>
                                <td>{{ $category->name }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop