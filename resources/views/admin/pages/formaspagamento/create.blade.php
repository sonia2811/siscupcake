@extends('adminlte::page')

@section('title', 'Cadastrar Nova Forma de Pagamento')

@section('content_header')
    <h1>Cadastrar Nova Forma de Pagamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('formaspagamento.store') }}" class="form" method="POST" enctype="multipart/form-data">
                
                @include('admin.pages.formaspagamento._partials.form')
                
            </form>
        </div>
    </div>
@stop