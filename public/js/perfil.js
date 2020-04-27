function name(params) {
    
}
$('#register-form').submit(function(event){
    event.preventDefault();
    $.ajax({
    url: url.origin+'/cliente/cadastro',
    type: 'post',
    dataType: 'json',
    data:$(this).serialize(),
    }).done((resposta)=>{
        if (!resposta.resultador) {
            $('#register-form input[name="'+resposta.name+'"]').focus().addClass('uk-form-danger')
            UIkit.notification({
                message: resposta.mensagem,
                status: 'danger',
                pos: 'bottom-right',
                timeout: 5000
            });
            
        }
        if(resposta.resultador){
            UIkit.notification({
                message: resposta.mensagem,
                status: 'success',
                pos: 'bottom-right',
                timeout: 5000
            });
        }
    })
})

$('#login-form').submit(function(event){
    event.preventDefault()
    $.ajax({
        url: url.origin+'/cliente/login/entra',
        type: 'post',
        dataType: 'json',
        data: $(this).serialize(),
    }).done((resposta)=>{
        if (!resposta.resultador) {
            $('#login-form input[name="'+resposta.name+'"]').focus().addClass('uk-form-danger')
            UIkit.notification({
                message: resposta.mensagem,
                status: 'danger',
                pos: 'bottom-right',
                timeout: 5000
            });
            
        }
        if(resposta.resultador){
            UIkit.notification({
                message: resposta.mensagem,
                status: 'success',
                pos: 'bottom-right',
                timeout: 5000
            });
            let id = localStorage.getItem('id');
            setTimeout(() => {
                location.href=url.origin+"/cesta/index/"+id+"/"+resposta.id
            }, 6000);
        }
    })
})
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
    url: url.origin+'/cliente/senha/enditar',
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
