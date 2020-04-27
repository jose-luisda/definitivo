
function CestaSalva(numero,precos,quantidades,descontos,usuarios) {
    let id = numero
    let preco = precos
    let desconto = descontos
    let data = datacertacliente();
    let quantidade = quantidades
    let usuario = usuarios
    if(usuarios){
         usuario = usuarios
         $('[name="id"]').val(usuario)
    }else{
        usuario = $('[name="id"]').val()
    }
    
    let dados = {
            'id': id,
            'preco':preco,
            'data':data,
            'desconto':desconto,
            'quantidade':quantidade,
            'usuario':usuario
    }
    $.ajax({

        type:'POST',
        dataType: 'json',
        url:url.origin+'/cesta/salva',

        data:dados,

        success:function(data){
            if (data.resultador) {
                indexcesta()
                cesta()
                UIkit.notification({
                    message: 'Item adicionador com sucesso!',
                    status: 'success',
                    pos: 'bottom-left',
                    timeout: 5000
                });
            }else{
                location.href=url.origin+"/cliente/precadastro"
            }
        }

     });
}
function SalvaCesta(numero,precos,descontos,usuarios) {
    let id = numero
    let preco = precos
    let desconto = descontos
    let data = datacertacliente();
    let quantidade = $('[name="productquantity"]').val()
    let usuario = usuarios
    if(usuarios){
         usuario = usuarios
         $('[name="id"]').val(usuario)
    }else{
        usuario = $('[name="id"]').val()
    }
    
    let dados = {
            'id': id,
            'preco':preco,
            'data':data,
            'desconto':desconto,
            'quantidade':quantidade,
            'usuario':usuario
    }
    
    $.ajax({

        type:'POST',
        dataType: 'json',
        url:url.origin+'/cesta/salva',

        data:dados,

        success:function(data){
            if (data.resultador) {
                indexcesta()
                cesta()
                UIkit.notification({
                    message: 'Item adicionador com sucesso!',
                    status: 'success',
                    pos: 'bottom-left',
                    timeout: 5000
                });
            }else{
                // location.href=url.origin+"/cliente/precadastro"
            }
        }

     });
}
function cesta() {
    let id = $('[name="id"]').val()
    $.ajax({
    url: url.origin+'/cesta/json/'+id,
    type: 'get',
    dataType: 'json',
    data:'',
    }).done((resposta)=>{
        if(resposta.resultador){
            CestaMostra(resposta.mensagem)
        }else{
            CestaMostra(resposta.resultador)
        }
   })    
}
cesta()
function CestaMostra(params) {
    var total = 0;
    var quantidade = 0;
    $("#cesta").empty();
    $('#total').empty();
    $('#total').text('R$ 00,00')
    $('#subtotal').empty();
    $('#subtotal').text('R$ 00,00')
    $('#cartqty').text(quantidade)
    if (params) {
        params.forEach((element,index) => {
            $('<tr></tr>',{
                
            }).append($('<td></td>',{
                class:"text-center",
                html:()=>{
                    return $('<a></a>',{
                        href:"#",
                        append:()=>{
                            if (element.foto) {
                                return $('<img/>',{
                                    src:url.origin+element.foto,
                                    alt:"iPod Classic",
                                    title:"iPod Classic"
                                })
                            } else {
                                return $('<img/>',{
                                    src:url.origin+"/images/product/tarja_vermelha.jpg",
                                    alt:"iPod Classic",
                                    title:"iPod Classic"
                                })
                            }
                        }
                    })
                }
            }),$('<td></td>',{
                class:"text-left product-name",
    
            }).append($('<a></a>',{
                href:"#",
                text:element.nome+ ' '+ element.tipo
            }),$('<span></span>',{
                class:"text-left price",
                text:'R$'+element.total.toFixed(2).toString().replace(".", ",")
            }),$('<input/>',{
                class:"cart-qtys cart-qty", 
                name:"product_quantity", 
                min:"1", 
                value:()=>{
                    if(element.quantidade){
                        return element.quantidade
                    }else{
                        return 1
                    }
                }, 
                type:"",
            }),$('<input/>',{
                class:"descontos",  
                type:"hidden",
                value:element.desconto
            }),$('<input/>',{
                class:"precos", 
                type:"hidden",
                value:element.preco
            }),$('<input/>',{
                class:"ids", 
                type:"hidden",
                value:element.id
            })),$('<td></td>',{
                class:"text-center",
               
                html:()=>{
                    return $('<a></a>',{
                        class:"close-cart",
                        html:()=>{
                            return $('<i></i>',{
                                class:"fa fa-times-circle"
                            })
                        }
                    }).attr("onclick","CestaExcluir("+element.id+')')
                }
            })).appendTo('#cesta')
            total += element.total
            quantidade ++
            $('#subtotal').text("R$"+total.toFixed(2).toString().replace(".", ","))
            $('#total').text("R$"+total.toFixed(2).toString().replace(".", ","))
           
        });
    } else {
        $('<div></div>',{
            class:"uk-alert-danger",
            html:()=>{
                return $('<p></p>',{
                    class:'uk-padding-small',
                    text:"Você ainda não tem nem um produto no seu carrinho."
                })
            }
        }).appendTo('#cesta')
    }
   
    $('#cartqty').text(quantidade)
   CestaAtualizar()
}
function CestaExcluir(excluir) {
    $.get( url.origin+"/cesta/deleta/"+excluir, function(dados) {
        if (dados.resultador) {
            cesta()
            indexcesta()
            UIkit.notification({
                message: 'Excludor com sucesso!',
                status: 'success',
                pos: 'bottom-left',
                timeout: 5000
            });
           
           
        }
    },'json');
}

function CestaAtualizar() {
    
    let total = 0
    for (let index = 0; index < $('.cart-qtys').length; index++) {
        
       $('.cart-qtys').eq(index).keyup(()=>{
        total = ((((($('.descontos').eq(index).val()/100) * $('.precos').eq(index).val()) - $('.precos').eq(index).val()) * (parseInt($('.cart-qtys').eq(index).val())))*(-1))
        let dados = {
            "id":$('.ids').eq(index).val(),
            "quantidade":$('.cart-qtys').eq(index).val(),
            "total":total
        }
        $.ajax({

            type:'POST',
            dataType: 'json',
            url:url.origin+'/cesta/atualizar',
    
            data:dados,
    
            success:function(data){
                if (data.resultador) {
                   indexcesta()
                   cesta()
                   if (data.quantidade > 1) {
                    UIkit.notification({
                        message: 'Atualizador com sucesso!',
                        status: 'success',
                        pos: 'bottom-left',
                        timeout: 5000
                    });
                   }
                }
            }
    
         });
       })   
    }
}
