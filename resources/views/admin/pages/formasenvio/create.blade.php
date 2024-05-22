@extends('adminlte::page')

@section('title', 'Cadastrar Nova Forma de Envio')

@section('content_header')
    <h1>Cadastrar Nova Forma de Envio</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('formasenvio.store') }}" class="form" method="POST" enctype="multipart/form-data">
                
                @include('admin.pages.formasenvio._partials.form')
                
            </form>
        </div>
    </div>
@stop