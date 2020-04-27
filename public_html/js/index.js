$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});
// function listaprodutos(url) {
//     $.get( url, function(dados) {
//         if (dados.resultador) {
//             produtoslista.produtos = dados.produtos;
//         }
//     },'json');
// }


// document.getElementById('chatcliente').addEventListener('submit',(e)=>{
//     e.preventDefault();
//     let chat = new FormData(document.getElementById('chatcliente'));

//     $.ajax({
//       url: 'rotas/chat.php',
//       type: 'post',
//       dataType: 'json',
//       data: chat,
//       contentType: false,
//       cache: false,
//       processData: false,
//   }).done((resposta) => {
  
//   })
//   })


// // Usuario logado.
// var url_string = window.location.href;
// var url = new URL(url_string);
// var id = url.searchParams.get("id");
// if (id) {
//     produtoslista.id = id
// }

// // function cadastrocliente(e) {
// //     e.preventDefault()
// //     let dados = e.serialize();
// //     $.ajax({
// //         url: 'cliente/ordem/cadastro',
// //         type: 'post',
// //         daentType: false,
// //         cachetaType: 'json',
// //         data: dados,
// //         cont: false,
// //         processData: false,
// //     }).done((resposta) => {
    
// //     })
// // }
var url_string = window.location.href;
var url = new URL(url_string);
var parametros =  url.pathname;
var id = parametros.split('/');
var novoid = ''
function CestaSalva(numero,precos,quantidades,descontos,usuarios) {
    console.log(numero)
    let id = numero
    let preco = precos
    let desconto = descontos
    let data = datacertacliente();
    let quantidade = quantidades
    let usuario = usuarios
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
   
    
    
    if (id.length === 5) {
        novoid = id[4]
        indexcesta()
        chatindex()
        indexcliente()
    }else if (id.length === 4) {
        novoid = id[3]
        indexcesta()
        chatindex()
        indexcliente()
    }
    

    function indexcesta() {
        $.ajax({
        url: url.origin+'/cesta/index/json/'+novoid,
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
        var total = 0;
        $("#cestacompralateral").empty();
        $('#carrinhoheader').empty();
        $('#total').empty();
        $('#total').text('R$ 00,00')
        $('#carrinhoheader').text('00,00')
        if(params){
                params.forEach(element => {
                    let div = '<li>'
                        if (element.foto) {
                            div +='<img src="'+element.foto+'" width="50" height="50">'
                        }else{
                            div +='<img src="{{asset(images/tarja_vermelha.jpg)}}" width="50" height="50">'
                        }
                        div += '<span class="uk-text-top">'+element.nome+'.</span>'
                        div += '<div><strong>R$'+element.preco+'-'+element.desconto+'%</strong><br><strong>R$'+element.total.toString().replace(".", ",")+'</strong></div>'
                        div+= '<div class="uk-flex"><div class="excluircarrinho" onclick="Excluircesta('+element.id+')"><span uk-icon="icon: trash"></span>Excluir</div>'
                        div += ' <div class="uk-button-group uk-margin-small-left"><button class="uk-button uk-button" onclick="AtualizarCesta('+element.id+','+element.desconto+','+element.preco+','+element.quantidade+','+"'+'"+')">+</button><button class="uk-button uk-button-secondary" value="'+element.quantidade+'">'+element.quantidade+'</button><button class="uk-button uk-button" onclick="AtualizarCesta('+element.id+','+element.desconto+','+element.preco+','+element.quantidade+','+"'-'"+')">-</button></div></div>'
                        div += "</li>"
                    $('#cestacompralateral').append(div)
                    total += element.total
                    $('#total').text("R$"+total.toString().replace(".", ","))
                    $('#carrinhoheader').text(total.toString().replace(".", ",")) 
                });
        }
    }

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
        }
    },'json');
}

function AtualizarCesta(id,desconto,preco,quantidade,condicao) {
    let total = 0
    let quantidadenovo = 0
    if (condicao === '+') {
        quantidadenovo = parseInt(quantidade) + 1
        total = (((((desconto/100) * preco) - preco) * (parseInt(quantidade) + 1))*(-1))
    }else if (condicao === '-' && quantidade > 1) {
        total = (((((desconto/100) * preco) - preco) * (parseInt(quantidade) - 1))*(-1))
        quantidadenovo = parseInt(quantidade) - 1
    }else if (condicao === '-' && quantidade === 1) {
        quantidadenovo = quantidade
        total = ((((desconto/100) * preco) - preco)*(-1))
    }
   
    let dados = {
        "id":id,
        "quantidade":quantidadenovo,
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
}

function chatindex() {
    $.ajax({
    url: url.origin+'/chat/index/'+novoid,
    type: 'get',
    dataType: 'json',
    data:'',
    }).done((resposta)=>{
        if(resposta.resultador){
            Mostrachat(resposta.mensagem,resposta.dadosusuario)
        }else{
            Mostrachat('')
        }
    })
}

function Mostrachat(dados,usuario) {
    let div = '';
    $("#conteudochat").empty();    
    if (dados) {
        dados.forEach(element => {
            $('<div></div>',{
                class:"uk-flex conteinermensagem",
            }).append($('<input/>',{
                type:'hidden',
                name:'id',
                value:element.id
            }))
            .append($('<div></div>',{
                class:'avatar uk-visible@m uk-margin-small-top uk-margin-small-left uk-padding-small	uk-padding-remove-left	 uk-padding-remove-top'
            }).append($('<img>',{
                class:'circle',
                style:'width:100%;',
                src:function(){
                    if (usuario.foto) {
                        "{{url('images/logo.svg')}}"
                    }else{
                      return url.origin+"/images/avatar-12.png"
                    }
                }
            }))).append($('<div></div>',{
                class:'msj macro uk-width-4-5@s'
            }).append($('<div></div>',{
                class:'text text-r'
            }).append($('<p></p>',{
                html:element.mensagem
            })).append($('<p></p>',{
                class:'uk-text-left'
            }).append($('<small></small>',{
                class:'datahoras'
            }).text(element.created_at))))).appendTo('#conteudochat')
        });
        conteinermensagem();
    } else {
    location.href = url.origin+"/cliente/precadastro/"
        // $('<div></div>', {
        //     class: 'uk-flex'
        // }).append($('<div></div>',{
        //     class:'msj-rta macro uk-width-4-5@s'
        // }).append($('<div></div>',{
        //     class:'text text-r'
        // }).append($('<p></p>',{
        // }).append($('<h5></h5>',{
        //     text:'Estamos conectandor com um atendentir.'
        // }))).append($('<p></p>',{
        //     class:'uk-text-left'
        // }).append($('<small></small>',{
        //     class:'datahoras'
        // }).text('00/00/0000'))))).append($('<div></div>',{
        //     class:'avatar uk-visible@m uk-margin-small-top uk-margin-small-left uk-padding-small	uk-padding-remove-left	 uk-padding-remove-top'
        // }).append($('<img>',{
        //     class:'circle',
        //     style:'width:100%;',
        //     src:'https://a11.t26.net/taringa/avatares/9/1/2/F/7/8/Demon_King1/48x48_5C5.jpg'
        // }))) .appendTo('#conteudochat')

        
    }
    
}



$('#chatcliente').submit(function(event){
    event.preventDefault();
    $.ajax({
    url: url.origin+'/chat/salva',
    type: 'post',
    dataType: 'json',
    data:$(this).serialize(),
    }).done((resposta)=>{
        if(resposta.resultador){
            chatindex()
        }else{
            Mostrachat('')
        }
    })
})

function conteinermensagem() {
    $('.conteinermensagem').click(function(){
        $(this).toggleClass('classSelecionar uk-padding-small')
        for (let index = 0; index < $('.classSelecionar').length; index++) {
            let numero = 1
            numero += index
            $('#itenschat').text(numero)
            
        }
    })

    $('#deletacesta').mousedown(function(){
        let atributo = $('.conteinermensagem').attr('class');
        atributo = atributo.split(' ')
        atributo.forEach(element => {
            if (element === 'classSelecionar') {
                atributo  = element
            }
        });
        if (atributo === "classSelecionar") {
            for (let index = 0; index < $('.classSelecionar input').length; index++) {
                let excluir = $('.classSelecionar input').eq(index).val();
                $.get( url.origin+"/chat/deleta/"+excluir, function(dados) {
                    if (dados.resultador) {
                        UIkit.notification({
                            message: 'Excludor com sucesso!',
                            status: 'success',
                            pos: 'bottom-left',
                            timeout: 5000
                        });
                        chatindex()
                        $('#itenschat').text('0')
                    }
                },'json');
            }
        }else{
            UIkit.notification({
                message: 'Selecione um item para excluir!',
                status: 'danger',
                pos: 'bottom-left',
                timeout: 5000
            });
        }
        
    })
}
var bar = document.getElementById('js-progressbar');

UIkit.upload('.js-upload', {

    url: url.origin+'/chat/salva/arquivo',
    multiple: true,
    type:"POST",
    name:"file[]",
    params:{
        _token:$('meta[name="csrf-token"]').attr('content'),
        foto: ' ',
        usuario:$('input[name="usuariofk"]').val(),
        data:$('input[name="data"]').val(),
    },
    allow : '*.(jpg|jpeg|gif|png|pdf)',
    concurrent:10,
    type:"json",
    error: function () {
        console.log('error', arguments);
    },
    complete: function (environment) {
        var{response}=environment;
        if (response.resultador) {
            chatindex()
        }
    },

    loadStart: function (e) {
        console.log('loadStart', arguments);

        bar.removeAttribute('hidden');
        bar.max = e.total;
        bar.value = e.loaded;
    },

    progress: function (e) {
        console.log('progress', arguments);

        bar.max = e.total;
        bar.value = e.loaded;
    },

    loadEnd: function (e) {
        console.log('loadEnd', arguments);

        bar.max = e.total;
        bar.value = e.loaded;
    },

    // completeAll: function () {
    //     console.log('completeAll', arguments);

    //     setTimeout(function () {
    //         bar.setAttribute('hidden', 'hidden');
    //     }, 1000);

    //     alert('Upload Completed');
    // }

});

function datacertacliente() {
    var data = new Date();
    var dia  = data.getDate();
    var mes  = data.getMonth()+1;
    var ano  = data.getFullYear();
    var hora = data.getHours();         
    var min  = data.getMinutes();        
    var seg  = data.getSeconds();
    let datacerta = dia+'/'+mes+'/'+ano+' '+hora+':'+min+':'+seg;
    return datacerta;
}

function indexcliente() {
    $.ajax({
    url: url.origin+'/cliente/editar/'+novoid,
    type: 'get',
    dataType: 'json',
    data:'',
    }).done((resposta)=>{
        if(resposta.resultador){
            MostraDados(resposta.dadoscliente,resposta.dadosendereco)
        }
    })
}

function MostraDados(cliente,endereco) {
    var dados = Object.assign({}, cliente, endereco);
    $('#clientecadastra input[name="id"]').val(dados.id)
    $('#clientecadastra input[name="nome"]').val(dados.nome)
    $('#clientecadastra input[name="email"]').val(dados.email)
    $('#clientecadastra input[name="sexo"]').val(dados.sexo)
    $('#clientecadastra input[name="rg"]').val(dados.rg)
    $('#clientecadastra input[name="dataemicao"]').val(dados.dataemicao)
    $('#clientecadastra input[name="cpf"]').val(dados.cpf)
    $('#clientecadastra input[name="nascimento"]').val(dados.nascimento)
    $('#clientecadastra input[name="celular"]').val(dados.celular)
    $('#clientecadastra input[name="cep"]').val(dados.cep)
    $('#clientecadastra input[name="rua"]').val(dados.rua)
    $('#clientecadastra input[name="bairro"]').val(dados.bairro)
    $('#clientecadastra input[name="cidade"]').val(dados.cidade)
    $('#clientecadastra input[name="estado"]').val(dados.estado)
    $('#clientecadastra input[name="numero"]').val(dados.numero)
    $('#clientecadastra input[name="complemento"]').val(dados.complemento)
}
$('#clientecadastra').submit(function(event){
    event.preventDefault();
    $.ajax({
    url: url.origin+'/cliente/atualizar',
    type: 'post',
    dataType: 'json',
    data:$(this).serialize(),
    }).done((resposta)=>{
        if(resposta.resultador){
            UIkit.notification({
                message: resposta.mensagem,
                status: 'success',
                pos: 'bottom-left',
                timeout: 5000
            });
            indexcliente();
        }else{
            UIkit.notification({
                message: resposta.mensagem,
                status: 'danger',
                pos: 'bottom-left',
                timeout: 5000
            });
        }
    })
})

$('#alterar-senha').submit(function(event){
    event.preventDefault();
    $.ajax({
    url: url.origin+'/cliente/historico/senha/enditar',
    type: 'post',
    dataType: 'json',
    data:$(this).serialize(),
    }).done((resposta)=>{
        if(resposta.resultador){
            UIkit.notification({
                message: resposta.mensagem,
                status: 'success',
                pos: 'bottom-left',
                timeout: 5000
            });
        }else{
            UIkit.notification({
                message: resposta.mensagem,
                status: 'danger',
                pos: 'bottom-left',
                timeout: 5000
            });
        }
    })
})


function CestaAtualizar(id,desconto,preco,quantidade,condicao) {
    let total = 0
    let quantidadenovo = 0
    if (condicao === '+') {
        quantidadenovo = parseInt(quantidade) + 1
        total = (((((desconto/100) * preco) - preco) * (parseInt(quantidade) + 1))*(-1))
    }else if (condicao === '-' && quantidade > 1) {
        total = (((((desconto/100) * preco) - preco) * (parseInt(quantidade) - 1))*(-1))
        quantidadenovo = parseInt(quantidade) - 1
    }else if (condicao === '-' && quantidade === 1) {
        quantidadenovo = quantidade
        total = ((((desconto/100) * preco) - preco)*(-1))
    }
    let dados = {
        "id":id,
        "quantidade":quantidadenovo,
        "total":total
    }

     
    $.ajax({

        type:'POST',
        dataType: 'json',
        url:url.origin+'/cesta/atualizar',

        data:dados,

        success:function(data){
            if (data.resultador) {
               if (data.quantidade > 1) {
                CestaIndex(data.quantidade)
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
}

function CestaIndex(params) {
    if (params) {
        $.ajax({
        url: url.origin+'/cesta/index/json/'+novoid,
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
}
function CestaMostra(parametros) {
   $('#cestabody').empty()
   $('#itens').text(parametros.length+" Itens")
   if (parametros) {
   parametros.forEach(element => {
    $('<tr></tr>').append($('<td></td>',{
        html:()=>{
            if (element.foto) {
                return "<img src='"+url.origin+"/"+element.foto+"'class='img-responsive' width='100'/>"
            }else{
                return "<img src='"+url.origin+"/"+"images/tarja_vermelha.jpg'class='img-responsive' width='100'>"
            }
        }
       }),$('<td></td>',{
        html:()=>{
            return "<span>"+element.tipo+' '+element.nome+'</span>-'+"&nbsp;<br><span class='text-muted'></span>"
        }
       }),$('<td></td>',{
           class:"text-right",
           html:'<div class="uk-button-group uk-margin-small-left"><button class="uk-button uk-button" onclick="CestaAtualizar('+element.id+','+element.desconto+','+element.preco+','+element.quantidade+','+"'+'"+')">+</button><button class="uk-button  uk-background-default uk-text-lead uk-text-small" value="'+element.quantidade+'">'+element.quantidade+'</button><button class="uk-button uk-button" onclick="CestaAtualizar('+element.id+','+element.desconto+','+element.preco+','+element.quantidade+','+"'-'"+')">-</button></div>'
       }),$('<td></td>',{
           class:"text-right uk-text-center",
           text:"R$"+element.preco.toFixed(2).toString().replace(".", ",")
       }),$('<td></td>',{
        class:"text-right uk-text-center",
        text:element.desconto+"%"
       }),$('<td></td>',{
        class:"text-right uk-text-center",
        text:()=>{
            return "R$"+(((((element.desconto/100)*element.preco)-element.preco)*element.quantidade)*(-1)).toFixed(2).toString().replace(".", ",")
        }
       }),$('<td></td>',{
        class:"uk-text-center",
        html:'<a class="uk-icon-button uk-icon" onclick="CestaExcluir('+element.id+')" href="#" uk-icon="icon: trash"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="trash"><polyline fill="none" stroke="#000" points="6.5 3 6.5 1.5 13.5 1.5 13.5 3"></polyline><polyline fill="none" stroke="#000" points="4.5 4 4.5 18.5 15.5 18.5 15.5 4"></polyline><rect x="8" y="7" width="1" height="9"></rect><rect x="11" y="7" width="1" height="9"></rect><rect x="2" y="3" width="16" height="1"></rect></svg></a>'
       })).appendTo('#cestabody')
   });
 }else{
    $('#itens').text("0 Itens")
    $('#content').html('<div class="uk-alert-danger" uk-alert><p>Olá seja bem vindo seu carrinho esta vazio click no botão  <strong>CONTINUAR COMPRANDO</strong> para fazer suas compras.</p></div>')
 }
}

function CestaExcluir(excluir) {
    $.get( url.origin+"/cesta/deleta/"+excluir, function(dados) {
        if (dados.resultador) {
            UIkit.notification({
                message: 'Excludor com sucesso!',
                status: 'success',
                pos: 'bottom-left',
                timeout: 5000
            });
            CestaIndex(dados.resultador)
        }
    },'json');
}

function listaprodutos(ondem) {
    $.get( url.origin+"/produtos/ordem/"+ondem, function(dados) {
        if (dados.resultador) {
            MostraProdutos(dados.produtos)
        }
    },'json');
}
function Classificarpor(ondem) {
    $.get( url.origin+"/produtos/ordem/preco/"+ondem, function(dados) {
        if (dados.resultador) {
            MostraProdutos(dados.produtos)
        }
    },'json');
}
function MostraProdutos(produtos) {
    $('#conteinerprodutos').empty()
    if (produtos) {
        produtos.forEach(element => {
            $('<div></div>',{
                class:"uk-flex uk-flex-wrap uk-flex-center uk-width-1-5@m"
            }).append($('<div></div>',{
                class:'uk-card uk-card-default produtos'
            }).append($('<div></div>',{
                class:"uk-card-media-top",
                html:()=>{
                    if (element.foto) {
                        return $('<a></a>',{
                            href:""
                        }).append($("<img/>",{
                            src:url.origin+"/"+element.foto,
                            alt:""
                        }).attr({
                            height:"150",
                            width:"0"
                        }))
                    }else{
                        return $('<a></a>',{
                            href:""
                        }).append($("<img/>",{
                            src:url.origin+"/images/tarja_vermelha.jpg",
                            alt:""
                        
                        }).attr({
                            height:"150",
                            width:""
                        }))
                    }
                }
            }),$("<div></div>",{
                class:"uk-card-body",
               
            }).append($('<h5></h5>',{
                class:"",
                html:()=>{
                    return $("<a></a>",{
                        href:url.origin+"/produtos/home/"+element.id,
                        text:element.nome
                    })
                }
            }),$('<p></p>').append($('<strong></strong>',{
                text:"R$"+element.preco.toFixed(2).toString().replace(".", ",")+" - "+element.desconto+"%"
            }),$('<br>'),$("<strong></strong>",{
                class:"preco",
                text: ((((element.desconto/100)*element.preco)-element.preco)*(-1)).toFixed(2).toString().replace(".", ",")
            }),$("<span></span>",{
                class:"uk-text-meta",
                text:" Cada"
            })),$('<div></div>',{

            }).append($("<button></button>",{
                class:"uk-button uk-button uk-width-1-1 uk-margin-small-bottom title-login",
                onclick:"CestaSalva(element.id,element.preco,1,element.desconto)",
                text:"Adicionar"
            }),$("<a></a>",{
                href:""
            }).append($("<button></button>",{
                class:"uk-button uk-button uk-width-1-1 uk-margin-small-bottom compracliente",
                text:"Comprar"
            })))))).appendTo("#conteinerprodutos")
        });
    }
}