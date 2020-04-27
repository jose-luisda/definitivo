<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endereco;
class EnderecoController extends Controller
{
    public function PrecadastroEndereco(Request $request)
    {
        $dados = $request->all();
        $id = Endereco::insertGetId([
            'cep'=>$dados['cep'],
            'usuariofk'=>$dados['_token'],
            'rua'=>$dados['rua'],
            'bairro'=>$dados['bairro'],
            'cidade'=>$dados['cidade'],
            'estado'=>$dados['uf'],
        ]); 
        if ($id) {
            return response()->json([
                'resultador'=>true,
                'mensagem'=>'Cadastro realizado com sucesso!',
                'id'=> $dados['_token']
            ]);
        }
    }
}
