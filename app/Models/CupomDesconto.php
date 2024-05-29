<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CupomDesconto extends Model
{
    protected $fillable = [
        'nome',
        'localizador',
        'desconto',
        'modo_desconto',
        'limite',
        'modo_limite',
        'dthr_validade',
        'ativo'
    ];
    
    public function search($filter = null)
    {
        $results = $this->where('nome', 'LIKE', "%{$filter}%")
                ->latest()
                ->paginate();
        
        return $results;
    }
}