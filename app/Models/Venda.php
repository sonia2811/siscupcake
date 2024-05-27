<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    
    protected $fillable = [
        'usuario_id',
        'forma_pagamento_id',
        'forma_envio_id',
        'valor',
        'pago',
        'cancelado'
    ];
    
    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class, 'venda_id');
    }
    
    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class);
    }
    
    public function formaEnvio()
    {
        return $this->belongsTo(FormaEnvio::class);
    }
}
