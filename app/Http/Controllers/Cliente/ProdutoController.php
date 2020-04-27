<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produto;
use DB;
class ProdutoController extends Controller
{
    function index()
    {
       $produtos = new Produto;
       $produtos =  $produtos->Lista();
      return view('index',compact('produtos'));
    }
    function Ordem($tipo,$ordem,$numero,$id = null)
    {
       $cesta = DB::table('cestas')
      ->join('produtos', 'produtos.id', '=', 'cestas.produtofk')
      ->select('produtos.nome','produtos.tipo','produtos.codigointerno','produtos.foto','produtos.unidade', 
      "cestas.id",'cestas.quantidade','cestas.preco','cestas.total','cestas.desconto','cestas.usuariofk','cestas.produtofk')
      ->where('cestas.usuariofk', '=', $id)
      ->get();
        $produtos = new Produto;
        $produtos =  $produtos->NumeroOrdem($tipo,$ordem,$numero);
        return view('index',compact('produtos','id','cesta'));
    }
    function ClassificaPreco($numero)
    {
      $produtos = new Produto;
      $produtos =  $produtos->NumeroOrdemAsc($numero);
      return response()->json([
                          'resultador'=>true,
                          'produtos'=>$produtos
                          ]);
    }
    function Categoria($tipo,$id = null)
    {
      $cesta = DB::table('cestas')
      ->join('produtos', 'produtos.id', '=', 'cestas.produtofk')
      ->select('produtos.nome','produtos.tipo','produtos.codigointerno','produtos.foto','produtos.unidade', 
      "cestas.id",'cestas.quantidade','cestas.preco','cestas.total','cestas.desconto','cestas.usuariofk','cestas.produtofk')
      ->where('cestas.usuariofk', '=', $id)
      ->get();
      $produtos = new Produto;
      $produtos =  $produtos->Categoria($tipo);
      return view('index',compact('produtos','id','cesta'));
     
    }
    function PerfilAuto($idproduto)
    {
        $produtos = new Produto;
        $produtos = $produtos->Perfil($idproduto);
        if (count($produtos)>=1) {
          return response()->json([
            'resultador'=>true,
            'produtos'=>$produtos
            ]);
        }else{
          return response()->json([
            'resultador'=>false,
            'produtos'=>$produtos
            ]);
        }
    }
    function Perfilproduto($idproduto,$idcliente = null)
    {
     
        $produtos = new Produto;
        $produtos = $produtos->Perfil($idproduto);
        $id = $idcliente;
        $cesta = DB::table('cestas')
        ->join('produtos', 'produtos.id', '=', 'cestas.produtofk')
        ->select('produtos.nome','produtos.tipo','produtos.codigointerno','produtos.foto','produtos.unidade', 
        "cestas.id",'cestas.quantidade','cestas.preco','cestas.total','cestas.desconto','cestas.usuariofk','cestas.produtofk')
        ->where('cestas.usuariofk', '=', $id)
        ->get();
        return view('perfilproduto',compact('produtos','id','cesta'));
    }
    function Perfil($idproduto)
    {
        $produtos = new Produto;
        $produtos = $produtos->Perfil($idproduto);
        return view('perfilproduto',compact('produtos'));
    }
   
    function Home($id = null)
    {
      $produtos = new Produto;
      $produtos =  $produtos->Lista();
      return view('index',compact('produtos','id'));
    }
    function Busca(Request $rel,$id)
    {
      $dados = $rel->all();
      $produtos = new Produto;
      $produtos =  $produtos->ProdutoBusca($dados['q']);
      return view('index',compact('produtos','id'));
    }


}
