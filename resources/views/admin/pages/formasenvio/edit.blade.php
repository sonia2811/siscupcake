@extends('adminlte::page')

@section('nome', "Editar a Forma de Envio { $formaEnvio->nome }")


@section('content_header')
    <h1>Editar a Forma de Envio {{ $formaEnvio->nome }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('formasenvio.update', $formaEnvio->id) }}" class="form" method="POST"  enctype="multipart/form-data">
                @method('PUT')
                
                @include('admin.pages.formasenvio._partials.form')
                
            </form>
        </div>
    </div>
@stop