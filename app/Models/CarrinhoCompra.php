<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarrinhoCompra extends Model
{
    
    protected $fillable = [
        'usuario_id',
        'venda_id',
        'criado_em'
    ];
    
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    
    public function itensCarrinhoCompra()
    {
        return $this->hasMany(ItemCarrinhoCompra::class, 'carrinho_compra_id');
    }
}