<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    
    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'preco_compra',
        'subtotal'
    ];


    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
    
    public function produto()
    {
        return $this->belongsTo(Product::class);
    }
    
}