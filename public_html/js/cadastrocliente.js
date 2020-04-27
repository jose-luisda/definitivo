$(function(){
    var url_string = window.location.href;
    var url = new URL(url_string);
    $.ajaxSetup({

        headers: {
    
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    
        }
    
    });
    $('#precadastro').submit(function(event){
        event.preventDefault()
        $.ajax({
            url: url.origin+'/cliente/cadastro',
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
        }).done((resposta)=>{
            if (!resposta.resultador) {
                $('#precadastro input[name="'+resposta.name+'"]').focus().addClass('uk-form-danger')
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
                setTimeout(() => {
                    location.href= url.origin+"/cesta/index/"+resposta.id
                }, 6000);
            }
        })
    })
    $('#login').submit(function(event){
        event.preventDefault()
        $.ajax({
            url: url.origin+'/cliente/login',
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
        }).done((resposta)=>{
            if (!resposta.resultador) {
                $('#login input[name="'+resposta.name+'"]').focus().addClass('uk-form-danger')
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

                setTimeout(() => {
                    location.href= url.origin+"/cesta/index/"+resposta.id
                }, 6000);
            }
        })
    })
})
function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value=("");
    document.getElementById('bairro').value=("");
    document.getElementById('cidade').value=("");
    document.getElementById('uf').value=("");
}

function meu_callback(conteudo) {
if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById('rua').value=(conteudo.logradouro);
    document.getElementById('bairro').value=(conteudo.bairro);
    document.getElementById('cidade').value=(conteudo.localidade);
    document.getElementById('uf').value=(conteudo.uf);
} //end if.
else {
    //CEP não Encontrado.
    limpa_formulário_cep();
    UIkit.notification({
        message: "CEP não encontrado.",
        status: 'danger',
        pos: 'bottom-right',
        timeout: 5000
    });
}
}

function pesquisacep(valor) {
//Nova variável "cep" somente com dígitos.
var cep = valor.replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep != "") {

    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if(validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById('rua').value="...";
        document.getElementById('bairro').value="...";
        document.getElementById('cidade').value="...";
        document.getElementById('uf').value="...";

        //Cria um elemento javascript.
        var script = document.createElement('script');

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);

    } //end if.
    else {
        //cep é inválido.
        limpa_formulário_cep();
        UIkit.notification({
            message: "Formato de CEP inválido.",
            status: 'danger',
            pos: 'bottom-right',
            timeout: 5000
        });
    }
} //end if.
else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
}
};