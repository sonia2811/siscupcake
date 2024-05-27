<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCarrinhoCompra extends Model
{
    
    protected $fillable = [
        'carrinho_compra_id',
        'produto_id',
        'quantidade',
        'valor',
        'subtotal',
        'cupom_desconto_id'
    ];
    
    public function carrinhoCompra()
    {
        return $this->belongsTo(CarrinhoCompra::class);
    }
    
    public function produto()
    {
        return $this->belongsTo(Product::class);
    }
    
}
