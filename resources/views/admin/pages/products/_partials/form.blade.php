@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>* Nome:</label>
    <input type="text" name="nome" class="form-control" placeholder="Nome:" value="{{ $product->nome ?? old('nome') }}" >
</div>
<div class="form-group">
    <label>* Descrição:</label>
    <input type="text" name="descricao" class="form-control" placeholder="Descrição:" value="{{ $product->descricao ?? old('descricao') }}" >
</div>
<div class="form-group">
    <label>* Valor:</label>
    <input type="text" name="valor" class="form-control" placeholder="Valor:" value="{{ $product->valor ?? old('valor') }}" >
</div>
<div class="form-group">
    <label>* Foto:</label>
    <input type="file" name="foto" class="form-control">
</div>
<div class="form-group">
    <label>* Ingredientes:</label>
    <textarea name="ingredientes" cols="30" rows="5" class="form-control" >{{ $product->ingredientes ?? old('ingredientes') }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>