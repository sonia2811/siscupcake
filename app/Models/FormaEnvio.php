<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaEnvio extends Model
{
    protected $fillable = [
        'nome',
        'valor',
    ];
    
    public function search($filter = null)
    {
        $results = $this->where('nome', 'LIKE', "%{$filter}%")
                ->latest()
                ->paginate();
        
        return $results;
    }
}
