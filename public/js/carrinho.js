function carrinhoRemoverProduto( idpedido, idproduto, item ) {
    $('#form-remover-produto input[name="pedido_id"]').val(idpedido);
    $('#form-remover-produto input[name="produto_id"]').val(idproduto);
    $('#form-remover-produto input[name="item"]').val(item);
    $('#form-remover-produto').submit();
}

function carrinhoSubtrairProduto( idpedido, idproduto, item ) {
    $('#form-subtrair-produto input[name="pedido_id"]').val(idpedido);
    $('#form-subtrair-produto input[name="produto_id"]').val(idproduto);
    $('#form-subtrair-produto input[name="item"]').val(item);
    $('#form-subtrair-produto').submit();
}

function carrinhoAdicionarProduto( idproduto ) {
    $('#form-adicionar-produto input[name="id"]').val(idproduto);
    $('#form-adicionar-produto').submit();
}