@extends('adminlte::page')

@section('nome', "Editar o Produto { $product->nome }")

@section('content_header')
    <h1>Editar o Produto {{ $product->nome }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" class="form" method="POST"  enctype="multipart/form-data">
                @method('PUT')
                
                @include('admin.pages.products._partials.form')
                
            </form>
        </div>
    </div>
@stop