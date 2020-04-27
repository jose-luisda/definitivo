var url_string = window.location.href;
var url = new URL(url_string);
var id = url.searchParams.get("id");
var pagamento = new Vue({
    el:'#content',
    data:{
        dados:""
    }
})

if (id && id === "null") {
    $.get( "rotas/trazercesta.php?pagamento="+id, function(dados) {
        if (dados.contador) {
            pagamento.dados = dados.dadostabela
        }
    })
}