<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'ativo'
    ];
    
    public function search($filter = null)
    {
        $results = $this->where('nome', 'LIKE', "%{$filter}%")
                ->orWhere('descricao', 'LIKE', "%{$filter}%")
                ->latest()
                ->paginate();
        
        return $results;
    }
    
    public function vendas()
    {
        
        return $this->hasMany(Venda::class, 'forma_pagamento_id');
        
    }
}
