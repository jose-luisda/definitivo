<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Cesta;
use DB;
class CestaController extends Controller
{
    function CestaSalva(Request $request)
    {
        $cesta = $request->all();
        if ($cesta['usuario'] != null) {
            $id = Cesta::insertGetId(
                ['produtofk'=>$cesta['id'],
                'preco'=>$cesta['preco'],
                'desconto'=>$cesta['desconto'],
                'dateregistro'=>$cesta['data'],
                'quantidade'=>$cesta['quantidade'],
                'total'=>($cesta['quantidade']*($cesta['preco']-($cesta['preco']*($cesta['desconto']/100)))),
                'usuariofk'=>$cesta['usuario']]
            );
            if ($id) {
                return response()->json([
                    'resultador'=>true,
                ]);
            }

        }else{
            return response()->json([
                'resultador'=>false,
                'mensagem'=> $cesta
            ]);
        }
    }
    function index($id=null,$ids=null)
    {
        if($ids !== null){
         Cesta::where('usuariofk',"=",$id)->update(['usuariofk'=>$ids]);
         $id =$ids;
         $quantidade = Cesta::where('usuariofk',"=",$id)->count();
        }else{
            $quantidade = Cesta::where('usuariofk',"=",$id)->count();
        }
        if ($quantidade) {
            $cesta = DB::table('cestas')
            ->join('produtos', 'produtos.id', '=', 'cestas.produtofk')
            ->select('produtos.nome','produtos.tipo','produtos.codigointerno','produtos.foto','produtos.unidade', 
            "cestas.id",'cestas.quantidade','cestas.preco','cestas.total','cestas.desconto','cestas.usuariofk','cestas.produtofk')
            ->where('cestas.usuariofk', '=', $id)
            ->get();
            return view('carrinho',compact('cesta','id'));
        }else{
          return redirect()->route('produtoshome',$id);
        }
    }
    function indexjson($id)
    {
        $cesta = DB::table('cestas')
            ->join('produtos', 'produtos.id', '=', 'cestas.produtofk')
            ->select('produtos.nome','produtos.tipo','produtos.codigointerno','produtos.foto','cestas.id', 
            'cestas.quantidade','cestas.preco','cestas.total','cestas.desconto','cestas.usuariofk')
            ->where('cestas.usuariofk', '=', $id)
            ->get();
        if (count($cesta) >= 1) {
            return response()->json([
                'resultador'=>true,
                'mensagem'=> $cesta
            ]);
        }else{
            return response()->json([
                'resultador'=>false,
            ]);
        }
    }
    function CestaDetela($id)
    {
        $excluir = Cesta::find($id)->delete();
        if ($excluir) {
            return response()->json([
                'resultador'=>true,
            ]);
        }
    }
    function CestaAtualizar(Request $request)
    {
        $cesta = $request->all();
        $atualizar = Cesta::find($cesta['id'])->update($cesta);
        if ($atualizar) {
            return response()->json([
                'resultador'=>true,
                'quantidade'=>$cesta['quantidade']
            ]);
        }
    }
}
