<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'cep', 'rua', 'bairro', 'cidade', 'estado', 'numero', 'complemento', 'usuariofk'
    ];
}
