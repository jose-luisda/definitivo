<?php
define("URL", "http://vrifu2no.srv-45-34-12-248.webserverhost.top/");

$sandbox = true;
if ($sandbox) {
    //Credenciais do SandBox
    define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA", "ljrri66@gmail.com");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "http://vrifu2no.srv-45-34-12-248.webserverhost.top");
} else {
    //Credenciais do PagSeguro
    define("SCRIPT_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA", "E-mail de suporte pós venda");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "https://sualoja.com.br/notifica.html");
}
?>