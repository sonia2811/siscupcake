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
}
