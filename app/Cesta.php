<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cesta extends Model
{
    protected $fillable = [
        'dateregistro', 'quantidade', 'preco', 'desconto', 'total', 'produtofk', 'usuariofk'
    ];
}
