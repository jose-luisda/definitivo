<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Endereco;
class UsuarioController extends Controller
{
    public function PrecadastroCliente(Request $request)
    {
        $dados = $request->all();
        $msg = '';
        $name = '';
      
            $resultador = Usuario::where('cpf',"=",$dados['cpf'])->count();
            if ($resultador) {
                $msg = " Este CPF já esta cadastro! ";
                $name = "cpf";
            }elseif (!$dados['cpf']) {
                $msg = " O campo CPF não pode esta vazio! ";
                $name = "cpf";
            }elseif ($dados['cpf']) {
                $valor = str_replace(array('.','-','/'), "", $dados['cpf']);
                $cpf = str_pad(preg_replace('[^0-9]', '', $dados['cpf']), 11, '0', STR_PAD_LEFT);
                
                if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'):
                    $msg = 'O campo cpf esta invalidor. O CPF não pode conter caracteres especiais e nem letras.';
                    $name = 'cpf';
                else: 
                    for ($t = 9; $t < 11; $t++):
                        for ($d = 0, $c = 0; $c < $t; $c++) :
                            $d += $cpf{$c} * (($t + 1) - $c);
                        endfor;
                        $d = ((10 * $d) % 11) % 10;
                        if ($cpf{$c} != $d):
                            $msg = 'O campo cpf esta invalidor. O CPF não pode conter caracteres especiais e nem letras.';
                            $name = 'cpf';
                        endif;
                    endfor;
                endif;
                if (!$dados['cep']) {
                    $msg = 'O campo não pode esta vazio.';
                    $name = 'cep';
                }elseif (strlen($dados['cep'])<5) {
                    $msg = 'O campo data de nascimento não pode ter menos de 5 caracteres.';
                    $name = 'cep';
                }elseif (!preg_match('/[0-9]{5,5}([-]?[0-9]{3})?$/', $dados['cep'])) {
                    $msg = 'O campo cep invalidor.';
                    $name = 'cep';
                }elseif (!$dados['email']) {
                    $msg = " O campo EMAIL não pode esta vazio! ";
                    $name = "email";
                }elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                    $msg = " Email incorreto! ";
                    $name = "email";
                }else if($dados['senha'] === ""){
                    $msg = " Campo deve ser preenchido.";
                    $name = "email";
                } else if(strlen($dados['senha']) > 20){
                    $msg = " Somente 20 caracteres são permitidos.";
                    $name = "email"; 
                } else if(strlen($dados['senha']) < 5){
                    $msg = " Mínimo de 5 caracteres.";
                    $name = "email"; 
                } else if(!preg_match("/^[a-zA-Z0-9]*$/", $dados['senha'])){
                    $msg = " Somente letras e números são permitidos. ";
                    $name = "email"; 
                }
            } 
            if ($msg) {
                return response()->json([
                    'resultador'=>false,
                    'mensagem'=>$msg,
                    'name'=>$name
                ]);
            }else {
                $id = Usuario::insertGetId(
                    ['email'=>$dados['email'], 'senha'=>md5($dados['senha']),'nome'=>$dados['nome']]
                ); 
                if ($id) {
                    return response()->json([
                        'resultador'=>false,
                        'mensagem'=>'Não foi possivel cadastra!'
                    ]);
                }
            }
        
    }
    function indexCadastro()
    {
        return view('precadastro');
    }

    function Editar($id)
    {
        $usuario = Usuario::where('id', $id)
        ->first(['id','nome','celular','sexo','rg','dataemicao','cpf','nascimento','foto','email']);
        $endereco = Endereco::where('usuariofk',$id)
        ->first(['cep','rua','bairro','cidade','estado','numero','complemento']);
        return response()->json([
            'resultador'=>true,
            'dadoscliente'=>$usuario,
            'dadosendereco'=>$endereco
        ]);

    }

    function Atualizar(Request $request)
    {
        $dados = $request->all();
        $usuario =  Usuario::find($dados['id'])
        ->update(['nome'=>$dados['NomeCompleto'],'celular'=>$dados['Telefone1'],'sexo'=>$dados['Sexo'],
        'cpf'=>$dados['Documento'],'nascimento'=>$dados['DataNascimento'],
        'email'=>$dados['Email']]);
        $endereco = Endereco::where('usuariofk',$dados['id'])
        ->update(['cep'=>$dados['CodigoPostal'],
        'estado'=>$dados['Uf'],'numero'=>$dados['Numero'],'complemento'=>$dados['Complemento']]);
        if ($usuario && $endereco) {
            return response()->json([
                'resultador'=>true,
                'mensagem'=>'Cadastro realizador com sucesso!',
            ]);
        }else{
            return response()->json([
                'resultador'=>true,
                'mensagem'=>'Não foi possivel realizar a atualização'
            ]);
        }
    }
}
