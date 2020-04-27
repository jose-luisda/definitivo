<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Usuario;
class LoginController extends Controller
{
    public function Login(Request $requete)
    {
        $dados = $requete->all();
        
        $idemail = Usuario::where("email",$dados["email"])->select('id')->first();
        $idsenha = Usuario::where('senha',md5($dados['senha']))->select('id')->first();
        if ($idemail['id'] === $idsenha['id'] && $idemail['id'] != null && $idsenha['id'] != null) {
            return response()->json([
                    'resultador'=>true,
                    'id'=>$idemail['id'],
                    'mensagem'=>'Login realizador com sucesso!'
                ]);
        }else{
            return response()->json([
                'resultador'=>false
            ]);
        }

    }
    public function Sair()
    {
        Auth::logout();
        return redirect()->route('/');
    }

    function index()
    {
        return view('login');
    }
}
