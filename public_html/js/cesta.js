var url_string = window.location.href;
var url = new URL(url_string);
var id = url.searchParams.get("id");
var perfilid = url.searchParams.get("perfilid");
var paginainicial = "id="+id+"&"+"perfilid="+perfilid

document.querySelectorAll('.paginainicial').forEach(element => {
    element.setAttribute('href',"index.php?"+paginainicial)
});
if (id && id != 'null') {
    var cestaheader = new Vue({
        el:'#cestaheader',
        data:{
            quantidadeitem:'',
        },
        methods:{
            paginaidentificacao:function(){
                return "indentificacao.php?id="+id
            }
        }
    })
    var cesta = new Vue({
        el:"#content",
        data:{
            produtos:""
        },
        methods:{
            desconto:function(descontor,preco){
                return((((descontor/100)*preco)-preco)*(-1)).toFixed(2).toString().replace(".", ",")
            },
            excluir:function(excluir){
                $.get( "rotas/excluircesta.php?id="+excluir, function(dados) {
                    if (dados.excluir) {
                        cestacompra()
                        UIkit.notification({
                            message: 'Excludor com sucesso!',
                            status: 'success',
                            pos: 'bottom-left',
                            timeout: 5000
                        });
                    }
                },'json');
            },
            atualizacao:function(id,usuario,desconto,preco,quantidade,condicao){
                let total = 0
                let quantidadenovo = 0
                if (condicao === '+') {
                    quantidadenovo = parseInt(quantidade) + 1
                    total = (((((desconto/100) * preco) - preco) * (parseInt(quantidade) + 1))*(-1))
                }else if (condicao === '-' && quantidade >= 1) {
                    total = (((((desconto/100) * preco) - preco) * (parseInt(quantidade) - 1))*(-1))
                    quantidadenovo = parseInt(quantidade) - 1
                }
                $.get( "rotas/atualizarcesta.php?id="+id+"&usuario="+usuario+"&quantidade="+quantidadenovo+"&total="+total, function(dados) {
                        if (dados.atualizacao) {
                            cestacompra()
                            UIkit.notification({
                                message: 'Atualizador com sucesso!',
                                status: 'success',
                                pos: 'bottom-left',
                                timeout: 5000
                            });
                        }
                },'json');
                
            },
            totalcompra:function(){
                var element = 0
                for (let index = 0; index < this.produtos.length; index++) {
                    element += parseInt(this.produtos[index].total);
                }
                return element.toFixed(2).toString().replace(".", ",");
            }
        },
        filters:{
            fotos:function(value){
                if (value) {
                    return value.substring(3);
                }else{
                    return "images/tarja_vermelha.jpg"
                }
            },
            desconto:function(value){
                let novovalor = parseFloat(value).toFixed(2).toString().replace(".", ",")
                return novovalor
            }
        }
    })
    function cestacompra() {
        $.get( "rotas/trazercesta.php?cesta="+id, function(dados) {
            if (dados.quantidade) {
                cesta.produtos = dados.produtos;
                cestaheader.quantidadeitem = dados.quantidade
                document.querySelectorAll('.pagamento').forEach(element => {
                    element.setAttribute('href',"indentificacao.php?id="+id)
                });
            }
            if(!dados.quantidade && id && id != 'null'){
                cesta.produtos = ''
                document.querySelectorAll('.pagamento').forEach(element => {
                    element.setAttribute('href',"index.php?id="+id)
                });
            }
        }, 'json')
    }
    cestacompra()
}else{
    location.href="indentificacao.php";
}
