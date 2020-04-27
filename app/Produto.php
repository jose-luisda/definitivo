<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    function Lista()
    {
        return Produto::all();
    }
    function NumeroOrdem($tipo,$ordem,$numero)
    {
        return Produto::where('id',">",1)->orderBy($tipo, $ordem)->take($numero)->get();
    }
    function Perfil($id)
    {
        return Produto::where('id',"=",$id)->get();
    }
    function NumeroOrdemAsc($numero)
    {
        return Produto::where('id',">",1)->orderBy('preco', 'asc')->take($numero)->get();
    }
    function Categoria($categoria)
    {
        return Produto::where('tipo',"=",$categoria)->get();
    }
    function ProdutoBusca($nome){
        return Produto::where('nome','LIKE' ,'%'.$nome. '%')->get();
    }
}
