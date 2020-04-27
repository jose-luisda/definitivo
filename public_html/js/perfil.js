

// var perfilproduto = new Vue({
//     el:"#lista-produtos",
//     data:{
//         produtos:'',
//         id:''
//     },
//     methods:{
//         desconto:function(descontor,preco){
//             return((((descontor/100)*preco)-preco)*(-1)).toFixed(2).toString().replace(".", ",")
//         },
//         valordoid:function(e){
//             let usuario = document.getElementById('usuario').value;
//             let quantidade = document.querySelector('#quantidade').value;
//             let preco =  this.produtos[0].preco;
//             let desconto = this.produtos[0].desconto;
//             let total = quantidade * ((((desconto/100)*preco)-preco)*(-1)).toFixed(2)
//             let produto = e.target.value;
//             var cesta= {
//                 dataregistro:datacertacliente(),
//                 quantidade:quantidade,
//                 preco:preco,
//                 desconto:desconto,
//                 total:total,
//                 usuario:usuario,
//                 id:produto
//             }
//             if (usuario && usuario != "null") {
//             $.post( "rotas/cestacompra.php?",cesta, function(dados) {
//                 if (dados.resultador) {
//                     cestacompra()
//                     UIkit.notification({
//                         message: 'Adicionado na carrinho de compra com sucesso!',
//                         status: 'success',
//                         pos: 'bottom-left',
//                         timeout: 5000
//                     });
//                 }
//             },'json');
//             }else{
//                 location.href="indentificacao.php"
//             }
            
//         },
//         quantidade:function(valor){
//             let quantidade = document.getElementById('quantidade').value
//             let quantidadeproduto = document.getElementById('quantidade')
//             if (valor === "+") {
//                  quantidade++
//                  quantidadeproduto.value = quantidade
//                  quantidadeproduto.innerText=quantidade
//             }else if (valor === "-" && quantidade >= 1) {
//                 quantidade --
//                 quantidadeproduto.value = quantidade
//                 quantidadeproduto.innerText=quantidade
            
//             }
//         }
//     },
//     filters:{
//         fotos:function(value){
//             if (value) {
//                 return value.substring(3);
//             }else{
//                 return "images/tarja_vermelha.jpg"
//             }
//         }
//     }
// })
$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});

function SalvaCesta() {
    let id = document.getElementById('id').value
    let preco = document.getElementById('preco').value
    let desconto = document.getElementById('descontor').value
    let data = document.getElementById('date').value
    let quantidade = document.getElementById('quantidade').value
    let usuario = document.getElementById('usuario').value
    let dados = {
            'id': id,
            'preco':preco,
            'desconto':desconto,
            'data':data,
            'quantidade':quantidade,
            'usuario':usuario
    }
    

    $.ajax({

        type:'POST',
        dataType: 'json',
        url:'http://localhost:8000/cesta/salva/',

        data:dados,

        success:function(data){
            if (data.resultador) {
                indexcesta()
                UIkit.notification({
                    message: 'Item adicionador com sucesso!',
                    status: 'success',
                    pos: 'bottom-left',
                    timeout: 5000
                });
            }else{
                location.href="http://localhost:8000/cliente/precadastro/"
            }
        }

     });
}
function quantidade(condicao) {
    var valor = document.getElementById('quantidade').value
    if (condicao === "+") {
        valor ++
        document.getElementById('quantidade').value = valor
        document.getElementById('quantidade').innerText = valor
    }else{
        if (valor > 1) {
            valor --
            document.getElementById('quantidade').value = valor
            document.getElementById('quantidade').innerText = valor   
        }
    }
}


