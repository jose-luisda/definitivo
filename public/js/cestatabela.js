function Excluircesta(excluir) {
    $.get( url.origin+"/cesta/deleta/"+excluir, function(dados) {
        if (dados.resultador) {
            
            UIkit.notification({
                message: 'Excludor com sucesso!',
                status: 'success',
                pos: 'bottom-left',
                timeout: 5000
            });
            indexcesta()
            cesta()
        }
    },'json');
}
function indexcesta() {
    let id = $('[name="id"]').val()
    $.ajax({
    url: url.origin+'/cesta/json/'+id,
    type: 'get',
    dataType: 'json',
    data:'',
    }).done((resposta)=>{
        if(resposta.resultador){
            Mostracesata(resposta.mensagem)
        }else{
            Mostracesata(resposta.resultador)
        }
   })    
}
function Mostracesata(params) {
    $('#tabelacesta').empty();
    if (params) {
        params.forEach((element,index) => {
            $('<tr></tr>',{
                
            }).append($('<td></td>',{
                class:"text-center col-md-1",
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
                class:"text-left",
                html:()=>{
                    return $('<a></a>',{
                        href:"product.html",
                        text:element.nome
                    })
                }
            }),$('<td></td>',{
                class:"text-left",
                text:element.tipo
            }),$('<td></td>',{
                class:"text-left",
                html:()=>{
                    return $('<div></div>',{
                        style:"max-width: 200px;",
                        class:"input-group btn-block"
                    }).append($('<input/>',{
                        type:"text",
                        class:"form-control quantidade quantity", 
                        size:"1",
                        value:element.quantidade,
                        name:"quantity"
                    }),$('<span></span>',{
                        class:"input-group-btn"
                    }).append($('<button></button>',{
                        class:"btn btn-danger",
                        onclick:"Excluircesta("+element.id+")",
                        html:'<i class="fa fa-times-circle"></i>'
                    })),$('<input/>',{
                        class:"preco", 
                        type:"hidden",
                        value:element.preco
                    }),$('<input/>',{
                        class:"id", 
                        type:"hidden",
                        value:element.id
                    }),$('<input/>',{
                        class:"descontor",  
                        type:"hidden",
                        value:element.desconto
                    }))
                }
            }),$('<td></td>',{
                class:"text-right",
                text:'R$'+((((element.desconto/100)*element.preco) - element.preco)*(-1)).toFixed(2).toString().replace(".", ",")
            }),$('<td></td>',{
                class:"text-right",
                text:'R$'+element.total.toFixed(2).toString().replace(".", ",")
            })).appendTo('#tabelacesta')
        })
        AtualizarCesta()
    }
}
function AtualizarCesta() {
    let total = 0
    for (let i = 0; i < $('.quantidade').length; i++) {
       $('.quantidade').eq(i).keyup(()=>{
        total = ((((($('.descontor').eq(i).val()/100) * $('.preco').eq(i).val()) - $('.preco').eq(i).val()) * (parseInt($('.quantidade').eq(i).val())))*(-1))
        let dados = {
            "id":$('.id').eq(i).val(),
            "quantidade":$('.quantidade').eq(i).val(),
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
AtualizarCesta()