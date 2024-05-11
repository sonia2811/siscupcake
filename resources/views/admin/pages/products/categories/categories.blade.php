@extends('adminlte::page')

@section('title', "Categorias do Produto {$product->title}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('product.categories', $product->id) }}" class="active">Categorias</a></li>
    </ol>

    <h1>Categorias do Produto <strong>{{$product->title}}</strong></h1>
    <a href="{{ route('product.categories.available', $product->id) }}" class="btn btn-dark">
        ADD NOVA CATEGORIA<i class="fas fa-plus-square"></i>
    </a>
    
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')
            
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td style="width: 250px">
                                <a href="{{ route('product.category.detach', [$product->id, $category->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
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