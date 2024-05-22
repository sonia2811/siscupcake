@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>* Nome:</label>
    <input type="text" name="nome" class="form-control" placeholder="Nome:" value="{{ $formaEnvio->nome ?? old('nome') }}" >
</div>
<div class="form-group">
    <label>* Valor:</label>
    <input type="text" name="valor" class="form-control" placeholder="Valor:" value="{{ $formaEnvio->valor ?? old('valor') }}" >
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>