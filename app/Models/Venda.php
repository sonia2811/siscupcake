<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    
    protected $fillable = [
        'usuario_id',
        'forma_pagamento_id',
        'valor',
        'data_venda'
    ];
    
    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class, 'venda_id');
    }
    
    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class);
    }
}
