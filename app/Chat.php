<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'mensagem', 'visualizar', 'funcionariofk', 'usuariofk', 'created_at'
    ];
}
