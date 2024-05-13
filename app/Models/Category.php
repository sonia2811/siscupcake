<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable = [
        'name',
        'url',
        'description'
    ];
    
    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', 'LIKE', "%{$filter}%")
                ->latest()
                ->paginate();
        
        return $results;
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
}