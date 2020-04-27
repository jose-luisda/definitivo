<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Usuario;
class ChatController extends Controller
{
    function index($id)
    {
        $chat = Chat::where('usuariofk',"=",$id)->get();
        $usuario = Usuario::where('id', $id)->first(['foto','nome']);
        if ($chat) {
            return response()->json([
                'resultador'=>true,
                'mensagem'=>$chat,
                'dadosusuario'=>$usuario
            ]);
        }else{
            return response()->json([
                'resultador'=>false
            ]);
        }
        
    }
    function Salva(Request $request)
    {
        $chat = $request->all();
        if ($chat['usuariofk'] !== null) {
            $id = Chat::insertGetId([
                'usuariofk'=>$chat['usuariofk'],
                'created_at'=>$chat['data'],
                'mensagem'=>$chat['mensagem']
            ]);
            if ($id) {
                return response()->json([
                    'resultador'=>true,
                ]);
            }
        }else{
            return response()->json([
                'resultador'=>false,
            ]);
        }
        
    }
    function Deleta($id)
    {
        $deleta = Chat::find($id)->delete();
        if($deleta){
            return response()->json([
                'resultador'=>true,
            ]);
        }
    }
    function Foto(Request $request)
    {
        $foto = $request->all();
        if($request->hasFile('file')){
            $arquivo = $request->file('file');
            foreach ($arquivo as $key => $value) {
                $num = rand(1111,9999);
                $dir = 'images/imagem';
                $ex = $value->guessClientExtension();
                $novoArquivo = "Arquivo".$num.".".$ex;
                $value->move($dir,$novoArquivo);
                $foto['foto'] .= "<img class='uk-width-1-3@m' src='http://localhost:8000/". $dir."/".$novoArquivo."'/>";
                
            }
        }
        $id = Chat::insertGetId([
            'usuariofk'=>$foto['usuario'],
            'created_at'=>$foto['data'],
            'mensagem'=>$foto['foto']
        ]);
        if ($id) {
            return response()->json([
                'resultador'=>true,
            ]);
        }
    }
}
