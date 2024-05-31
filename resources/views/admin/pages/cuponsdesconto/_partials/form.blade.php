@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>* Nome:</label>
    <input type="text" name="nome" class="form-control" placeholder="Nome:" value="{{ $cupomDesconto->nome ?? old('nome') }}" >
</div>
<div class="form-group">
    <label>* Localizador:</label>
    <input type="text" name="localizador" class="form-control" placeholder="Localizador:" value="{{ $cupomDesconto->localizador ?? old('localizador') }}" >
</div>
<div class="form-group">
    <label>* Modo Desconto:</label>
    <select name="modo_desconto" required="required">
        <option value="">Selecione...</option>
        <option value="porc" {{ isset($cupomDesconto->modo_desconto) && $cupomDesconto->modo_desconto == 'porc' ? ' selected ' : null }}>Porcentagem no valor do produto</option>
        <option value="valor" {{ isset($cupomDesconto->modo_desconto) && $cupomDesconto->modo_desconto == 'valor' ? ' selected ' : null }}>Valor fixo</option>
    </select>
</div>
<div class="form-group">
    <label>* Desconto:</label>
    <input type="text" name="desconto" class="form-control" placeholder="Desconto:" value="{{ $cupomDesconto->desconto ?? old('desconto') }}" >
</div>
<div class="form-group">
    <label>Modo de limite</label>
    <select name="modo_limite" required="required">
        <option value="">-- Selecione</option>
        <option value="qtd" {{ isset($cupomDesconto->modo_limite) && $cupomDesconto->modo_limite == 'qtd' ? ' selected ' : null }}>Quantidade de desconto</option>
        <option value="valor" {{ isset($cupomDesconto->modo_limite) && $cupomDesconto->modo_limite == 'valor' ? ' selected ' : null }}>Valor de desconto</option>
    </select>
</div>
<div class="form-group">
    <label>Limiti de desconto:</label>
    <input type="text" name="limite" class="form-control" placeholder="Limite:" value="{{ isset($cupomDesconto->limite) ? $cupomDesconto->limite : null }}" >
</div>
<div class="form-group">
    <label>Data vencimento</label>
    <input type="date" class="datepicker" name="dthr_validade" id="dthr_validade" value="{{ isset($cupomDesconto->dthr_validade) ? $cupomDesconto->dthr_validade : null }}" required="required">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>