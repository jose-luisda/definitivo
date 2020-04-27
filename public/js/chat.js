var me = {};
me.avatar = "https://lh6.googleusercontent.com/-lr2nyjhhjXw/AAAAAAAAAAI/AAAAAAAARmE/MdtfUmC0M4s/photo.jpg?sz=48";

var you = {};
you.avatar = "https://a11.t26.net/taringa/avatares/9/1/2/F/7/8/Demon_King1/48x48_5C5.jpg";

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}            

//-- No use time. It is a javaScript effect.
function insertChat(who, text,data,img,id,index, time){
    if (time === undefined){
        time = 0;
    }
    
    var control = "";
    var date = "";
    if(data){
        date = data
    }else{
        date = formatAMPM(new Date());
    }
    if (who == "me"){
        
        control = '<li onclick="Excluir('+index+')" class="mensagemconteiner" style="width:100%"  id="'+id+'">' +
                        '<div class="msj macro">' +
                        '<div class="avatar"><img class="img-circle" style="width:100%;" src="'+ me.avatar +'" /></div>' +
                            '<div class="text text-l">' +
                                '<p>'+ text +'</p>' +
                                '<p><small>'+date+'</small> <small class="marcadores">'+img+'</small></p>' +
                            '</div>' +
                        '</div>' +
                    '</li>'; 
                                        
    }else{
        control = '<li style="width:100%;">' +
                        '<div class="msj-rta macro">' +
                            '<div class="text text-r">' +
                                '<p>'+text+'</p>' +
                                '<p><small>'+date+'</small></p>' +
                            '</div>' +
                        '<div class="avatar" style="padding:0px 0px 0px 10px !important"><img class="img-circle" style="width:100%;" src="'+you.avatar+'" /></div>' +                                
                  '</li>';
                  
    }
    setTimeout(
        function(){                 
            $("ol").append(control).scrollTop($("ol").prop('scrollHeight'));
           
        }, time);
    
}

function resetChat(){
    $("ol").empty();
}

$(".mytext").on("keydown", function(e){
    if (e.which == 13){
        var text = $(this).val();
        if (text !== ""){
            var date = formatAMPM(new Date());
            let imagem =  '<img src="'+url.origin+"/images/product/marcadores.svg"+'"/>'
            insertChat("me",text,date,imagem);
            inserirchat("me",text,date)       
            $(this).val('');
        }
    }
});

$('body > div > div > div:nth-child(2) > span').click(function(){
    $(".mytext").trigger({type: 'keydown', which: 13, keyCode: 13});
})

//-- Clear Chat
resetChat();

//-- Print Messages
// insertChat("me", "Hello Tom...", 0);  
// insertChat("you", "Hi, Pablo", 1500);
// insertChat("me", "What would you like to talk about today?", 3500);
// insertChat("you", "Tell me a joke",7000);
// insertChat("me", "Spaceman: Computer! Computer! Do we bring battery?!", 9500);
// insertChat("you", "LOL", 12000);
function chatindex() {
    $.ajax({
    url: url.origin+'/chat/index/'+$('#id').val(),
    type: 'get',
    dataType: 'json',
    data:'',
    }).done((resposta)=>{
        if(resposta.resultador){
            resetChat();
            let imagem =  '<img src="'+url.origin+"/images/product/marcadores2.svg"+'"/>'  
            resposta.mensagem.forEach((element,index) => {
                if(element.usuariofk && !element.funcionariofk){
                    insertChat("me", element.mensagem, element.data,imagem,element.id,index);
                }
            })
            
        }else{
            Mostrachat('')
        }
    })
}
chatindex()

function inserirchat(who,text,date){
        let id = $('#id').val()
        let mensagem = text
        let data = date;
        $.ajax({
        url: url.origin+'/chat/salva',
        type: 'post',
        dataType: 'json',
        data:{
            'usuariofk':id,
            'data':data,
            'mensagem':mensagem
        },
        }).done((resposta)=>{
            if(resposta.resultador){
                chatindex()
            }else{
                // Mostrachat('')
            }
        })
} 

const dados = []
var quantidade = 0
function Excluir(i) {
    $('.mensagemconteiner').eq(i).toggleClass('selecionado')
    let atributo = $('.mensagemconteiner').eq(i).attr('class');
    atributo = atributo.split(' ')
    if (atributo[1] === 'selecionado') {
        dados[i] = $('.mensagemconteiner').eq(i).attr('id')
        let quant = $('#itens').text()
        $('#itens').text(parseInt(quant)+1)
    }else{
        dados[i] = 0
        let quant = $('#itens').text()
        $('#itens').text(parseInt(quant)-1)
    }
}
$('#excluircesta').click(function(){
    dados.forEach((element) => {
        if (element) {
                $.get( url.origin+"/chat/deleta/"+element, function(dados) {
                    if (dados.resultador) {
                        UIkit.notification({
                            message: 'Excludor com sucesso!',
                            status: 'success',
                            pos: 'bottom-left',
                            timeout: 5000
                        });
                        chatindex()
                        $('#itens').text('0')
                    }
                },'json');
        }
    });
})

var bar = document.getElementById('js-progressbar');

UIkit.upload('.js-upload', {

    url: url.origin+'/chat/salva/arquivo',
    multiple: true,
    type:"POST",
    name:"file[]",
    params:{
        _token:$('meta[name="csrf-token"]').attr('content'),
        foto: ' ',
        usuario:$('#id').val(),
        data:formatAMPM(new Date()),
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

    completeAll: function () {
        console.log('completeAll', arguments);

        setTimeout(function () {
            bar.setAttribute('hidden', 'hidden');
        }, 1000);

        UIkit.notification({
            message: 'Envio completo!',
            status: 'success',
            pos: 'top-center',
            timeout: 5000
        });
    }

});
//-- NOTE: No use time on insertChat.