var url_string = window.location.href;
var url = new URL(url_string);
var id = url.searchParams.get("id");
var perfilid = url.searchParams.get("perfilid");

$.get( "rotas/trazeprodutosdatas.php?perfilid="+perfilid, function(dados) {
    if (dados.quantidade) {
        perfilproduto.produtos = dados.produto;
    }
},'json');
function cestacompra() {
    $.get( "rotas/trazercesta.php?cesta="+id, function(dados) {
        if (dados.quantidade) {
            cestalateral.produtos = dados.produtos;
            painelcontrole.produtos = dados.produtos;
            cestalateral.totalcompra();
            painelcontrole.totalcompra()
        }else{
            cestalateral.produtos = ""
        }
    },'json');
}
cestacompra()
function datacertacliente() {
    var data = new Date();
    var dia  = data.getDate();
    var mes  = data.getMonth()+1;
    var ano  = data.getFullYear();
    var hora = data.getHours();         
    var min  = data.getMinutes();        
    var seg  = data.getSeconds();
    let datacerta = dia+'/'+mes+'/'+ano+' '+hora+':'+min+':'+seg;
    return datacerta
}
var cestalateral = new Vue({
    el:"#carrinhomobaio",
    data:{
        produtos:"",
        quantidade:""
    },
    methods:{
        totalcompra:function(){
            var element = 0
            for (let index = 0; index < this.produtos.length; index++) {
                element += parseInt(this.produtos[index].total);
            }
            return element.toFixed(2).toString().replace(".", ",");
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
        cestacompra:function(){
            location.href="cesta.php?perfilid="+perfilid+'&id='+id
        }
    },
    filters:{
        desconto:function(value){
            let novovalor = parseFloat(value).toFixed(2).toString().replace(".", ",")
            return novovalor
        }
    }
})

var painelcontrole = new Vue({
    el:'#painelcontraler',
    data:{
        produtos:""
    },
    methods:{
        totalcompra:function(){
            var element = 0
            for (let index = 0; index < this.produtos.length; index++) {
                element += parseInt(this.produtos[index].total);
            }
            return element.toFixed(2).toString().replace(".", ",");
        }
    }
})
