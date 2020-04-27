<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cesta;
use App\Usuario;
use App\Endereco;
use App\Produto;
use App\Venda;
use DB;
class VendaController extends Controller
{
    function index($id)
    {
        if ($id) {
            $vendas = Venda::find($id);
            $usuario = Usuario::where('id', $id)
            ->first(['cpf','email','id']);
            $produtos = DB::table('cestas')
            ->join('produtos', 'produtos.id', '=', 'cestas.produtofk')
            ->select('produtos.nome','produtos.tipo','produtos.codigointerno','produtos.foto','produtos.unidade', 
            "cestas.id",'cestas.quantidade','cestas.preco','cestas.total','cestas.desconto','cestas.usuariofk')
            ->where('cestas.usuariofk', '=', $id)
            ->get();
            return view('minhaconta',compact('id','vendas','usuario','produtos'));
        }
    }

    function AtualizarCadastro($id)
    {
        if ($id) {
            $usuario = Usuario::
            where('id', $id)
            ->first(['id','cpf','email']);
            $endereco = Endereco::where('usuariofk',$id)
            ->first(['cep','rua','bairro','cidade','estado']);
            return view('historicocadastro',compact('id','usuario','endereco'));
        }
    }

    function IndexSenha($id)
    {
        $usuario = Usuario::
        where('id', $id)
        ->first(['id','cpf','email']);
        $produtos = DB::table('cestas')
        ->join('produtos', 'produtos.id', '=', 'cestas.produtofk')
        ->select('produtos.nome','produtos.tipo','produtos.codigointerno','produtos.foto','produtos.unidade', 
        "cestas.id",'cestas.quantidade','cestas.preco','cestas.total','cestas.desconto','cestas.usuariofk')
        ->where('cestas.usuariofk', '=', $id)
        ->get();
        return view('senha',compact('id','usuario','produtos'));
    }
    function UpdateSenha(Request $rel)
    {
        $msg = '';
        $resultador = '';
        $senha = $rel->all();
        $id = Usuario::
        where('senha', md5($senha['SenhaAtual']))
        ->first(['id']);
        if($id['id']){
            if($senha['SenhaNova'] !== $senha['ConfirmaSenha']){
                $msg = 'O campo senha não em a mesma do campo confirma senha !';
                $resultador = false;
            }else{
                $id = Usuario::find($senha['id'])
                ->update(['senha'=>md5($senha['SenhaNova'])]);
                if($id){
                    $msg = 'O senha atualizadar com sucesso !';
                    $resultador = true;
                }
            }
        }else{
            $msg = 'A senha não conferi!';
            $resultador = false;
        }
        if($msg){
            return response()->json([
            'resultador'=>$resultador,
            'mensagem'=>$msg
            ]);
        }
    }

    function IndexPedidos($id){
        $usuario = Usuario::where('id', $id)
        ->first(['nome']);
        return view('visualizarpedidos',compact('id','usuario'));
    }

    function IndexPagamento($id)
    {
        $endereco = Endereco::where('usuariofk',$id)
        ->first(['cep','rua','bairro', 'cidade', 'estado', 'numero', 'complemento']);
       $total = 0;
       $cesta = Cesta::select('total')->where('usuariofk',$id)->get();
       foreach ($cesta as $key => $value) {
            $total += $value->total;
        }
       
       $usuario = Usuario::where('id',$id)
       ->first(['nome','nascimento','cpf','celular','email']);
       return view('pagamento',compact('id','endereco','usuario','total'));
    }
}