<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PagSeguroController extends Controller
{
    function PagseguroIdSessao(Request $request)
    {
        $sandbox = true;
        if ($sandbox) {
            //Credenciais do SandBox
            define("EMAIL_PAGSEGURO", "ljrri66@gmail.com");
            define("TOKEN_PAGSEGURO", "EDF8B0A4A0BF4680A429EB848B12BBA0");
            define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
        } else {
            //Credenciais do PagSeguro
            define("EMAIL_PAGSEGURO", "Seu e-mail do PagSeguro");
            define("TOKEN_PAGSEGURO", "Seu token no PagSeguro");
            define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
        }
        $url = URL_PAGSEGURO . "sessions?email=" . EMAIL_PAGSEGURO . "&token=" . TOKEN_PAGSEGURO;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($retorno);
        echo json_encode($xml);
    }

    function Proc_Pag(Request $request)
    {
        $sandbox = true;
        $contador = 1;
        
        $Dados = $request->all();
        $cesta = DB::table('cestas')
        ->join('produtos', 'produtos.id', '=', 'cestas.produtofk')
        ->select('produtos.nome','produtos.tipo','produtos.codigointerno','produtos.foto','produtos.unidade', 
        "cestas.id",'cestas.quantidade','cestas.preco','cestas.total','cestas.desconto','cestas.usuariofk')
        ->where('cestas.usuariofk', '=', $Dados['reference'])->get();
        
         if ($sandbox) {
            //Credenciais do SandBox
           define("EMAIL_PAGSEGURO", "ljrri66@gmail.com");
           define("TOKEN_PAGSEGURO", "EDF8B0A4A0BF4680A429EB848B12BBA0");
           define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
           define("EMAIL_LOJA", "ljrri66@gmail.com");
           define("URL_NOTIFICACAO", "http://vrifu2no.srv-45-34-12-248.webserverhost.top");
        } else {
            //Credenciais do PagSeguro
            define("EMAIL_PAGSEGURO", "Seu e-mail do PagSeguro");
            define("TOKEN_PAGSEGURO", "Seu token no PagSeguro");
            define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
            define("EMAIL_LOJA", "E-mail de suporte pós venda");
            define("URL_NOTIFICACAO", "https://sualoja.com.br/notifica.html");
        }
        $DadosArray["email"]=EMAIL_PAGSEGURO;
        $DadosArray["token"]=TOKEN_PAGSEGURO;

        $DadosArray['paymentMode'] = 'default';
        $DadosArray['paymentMethod'] = $Dados['paymentMethod'];
        //$DadosArray['receiverEmail'] = $Dados['receiverEmail'];
        $DadosArray['receiverEmail'] = EMAIL_LOJA;
        $DadosArray['currency'] = $Dados['currency'];
        $DadosArray['extraAmount'] = $Dados['extraAmount'];
        
        foreach ($cesta as $key => $value) {
        $DadosArray["itemId{$contador}"] = $value->id;
        $DadosArray["itemDescription{$contador}"] = $value->nome." ".$value->tipo;
        $total = $value->total / $value->quantidade;
        $DadosArray["itemAmount{$contador}"] = number_format($total, 2, '.', '');
        $DadosArray["itemQuantity{$contador}"] = $value->quantidade;
        $contador++;
        }
        
        $DadosArray['notificationURL'] = URL_NOTIFICACAO;
        $DadosArray['reference'] = $Dados['reference'];
        $DadosArray['senderName'] = $Dados['senderName'];
        $DadosArray['senderCPF'] = $Dados['senderCPF'];
        $DadosArray['senderAreaCode'] = $Dados['senderAreaCode'];
        $DadosArray['senderPhone'] = $Dados['senderPhone'];
        $DadosArray['senderEmail'] = $Dados['senderEmail'];
        $DadosArray['senderHash'] = $Dados['hashCartao'];
        $DadosArray['shippingAddressRequired'] = $Dados['shippingAddressRequired'];
        $DadosArray['shippingAddressStreet'] = $Dados['shippingAddressStreet'];
        $DadosArray['shippingAddressNumber'] = $Dados['shippingAddressNumber'];
        $DadosArray['shippingAddressComplement'] = $Dados['shippingAddressComplement'];
        $DadosArray['shippingAddressDistrict'] = $Dados['shippingAddressDistrict'];
        $DadosArray['shippingAddressPostalCode'] = $Dados['shippingAddressPostalCode'];
        $DadosArray['shippingAddressCity'] = $Dados['shippingAddressCity'];
        $DadosArray['shippingAddressState'] = $Dados['shippingAddressState'];
        $DadosArray['shippingAddressCountry'] = $Dados['shippingAddressCountry'];
        $DadosArray['shippingType'] = $Dados['shippingType'];
        $DadosArray['shippingCost'] = $Dados['shippingCost'];
        $DadosArray['creditCardToken'] = $Dados['tokenCartao'];
        $DadosArray['installmentQuantity'] = $Dados['qntParcelas'];
        $DadosArray['installmentValue'] = $Dados['valorParcelas'];
        $DadosArray['noInterestInstallmentQuantity'] = $Dados['noIntInstalQuantity'];
        $DadosArray['creditCardHolderName'] = $Dados['creditCardHolderName'];
        $DadosArray['creditCardHolderCPF'] = $Dados['creditCardHolderCPF'];
        $DadosArray['creditCardHolderBirthDate'] = $Dados['creditCardHolderBirthDate'];
        $DadosArray['creditCardHolderAreaCode'] = $Dados['senderAreaCode'];
        $DadosArray['creditCardHolderPhone'] = $Dados['senderPhone'];
        $DadosArray['billingAddressStreet'] = $Dados['billingAddressStreet'];
        $DadosArray['billingAddressNumber'] = $Dados['billingAddressNumber'];
        $DadosArray['billingAddressComplement'] = $Dados['billingAddressComplement'];
        $DadosArray['billingAddressDistrict'] = $Dados['billingAddressDistrict'];
        $DadosArray['billingAddressPostalCode'] = $Dados['billingAddressPostalCode'];
        $DadosArray['billingAddressCity'] = $Dados['billingAddressCity'];
        $DadosArray['billingAddressState'] = $Dados['billingAddressState'];
        $DadosArray['billingAddressCountry'] = $Dados['billingAddressCountry'];
        //dd($DadosArray);
        $buildQuery = http_build_query($DadosArray);
        $url = URL_PAGSEGURO . "transactions";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
        $retorno = curl_exec($curl);
        curl_close($curl);
        $xml = simplexml_load_string($retorno);
        $retorna = ['erro' => true, 'dados' => $xml, 'DadosArray' => $DadosArray];
        header('Content-Type: application/json');
        echo json_encode($retorna);

    }
}