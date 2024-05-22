@extends('adminlte::page')

@section('nome', "Editar a Forma de Pagamento { $formaPagamento->nome }")


@section('content_header')
    <h1>Editar a Forma de Pagamento {{ $formaPagamento->nome }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('formaspagamento.update', $formaPagamento->id) }}" class="form" method="POST"  enctype="multipart/form-data">
                @method('PUT')
                
                @include('admin.pages.formaspagamento._partials.form')
                
            </form>
        </div>
    </div>
@stop