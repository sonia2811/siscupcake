@extends('adminlte::page')

@section('title', "Editar o Cupom de Desconto { $cupomDesconto->nome }")

@section('content_header')
    <h1>Editar o Cupom de Desconto {{ $cupomDesconto->nome }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('cuponsdesconto.update', $cupomDesconto->id) }}" class="form" method="POST">
                @method('PUT')
                
                @include('admin.pages.cuponsdesconto._partials.form')
                
            </form>
        </div>
    </div>
@stop