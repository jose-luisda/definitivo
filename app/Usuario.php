<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome', 'celular', 'sexo', 'rg', 'dataemicao', 'cpf', 'nascimento', 'estacivil', 'foto', 'email', 'senha'
    ];
}
