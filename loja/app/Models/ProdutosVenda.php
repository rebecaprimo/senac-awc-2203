<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosVenda extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'produto_id', 'venda_id', 'quantidade', 'valor'];

    protected $table = 'produtosVenda';
}
