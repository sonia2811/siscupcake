@extends('adminlte::page')

@section('title', 'Cadastrar Novo Cupom de Desconto')

@section('content_header')
    <h1>Cadastrar Novo Cupom de Desconto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('cuponsdesconto.store') }}" class="form" method="POST">
                
                @include('admin.pages.cuponsdesconto._partials.form')
                
            </form>
        </div>
    </div>
@stop