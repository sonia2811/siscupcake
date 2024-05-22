<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCarrinhoCompra extends Model
{
    
    protected $fillable = [
        'carrinho_compra_id',
        'produto_id',
        'quantidade',
        'valor_unitario',
        'subtotal'
    ];
    
    public function carrinhoCompra()
    {
        return $this->belongsToMany(CarrinhoCompra::class);
    }
    
    public function produto()
    {
        return $this->belongsToMany(Produto::class);
    }
    
}
