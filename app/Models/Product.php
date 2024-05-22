<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'ingredientes',
        'foto'
    ];
    
    public function search($filter = null)
    {
        $results = $this->where('nome', 'LIKE', "%{$filter}%")
                ->orWhere('descricao', 'LIKE', "%{$filter}%")
                ->latest()
                ->paginate();
        
        return $results;
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function categoriesAvailable($filter = null)
    {
        
        $categories = Category::whereNotIn('categories.id', function ($query){
                $query->select('category_product.category_id');
                $query->from('category_product');
                $query->whereRaw("category_product.product_id = {$this->id}");
            })->where(function ($queryFilter) use($filter){
                if ($filter){
                    $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
                    $queryFilter->orWhere('categories.description', 'LIKE', "%{$filter}%");
                }
            })->paginate();
        
        return $categories;
    }
}
