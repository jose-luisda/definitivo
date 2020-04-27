var cadastroprodutosinput=document.querySelectorAll('.validate')
function cadastrocliente(e) {
    e.preventDefault()
    let rua = document.getElementById('rua').value;
    if (rua.length > 5) {
        let dado = new FormData(e.target)
        $.ajax({
            url: 'rotas/cadastrocliente.php',
            type: 'post',
            dataType: 'json',
            data: dado,
            contentType: false,
            cache: false,
            processData: false,
        }).done((resposta) => {
            if (resposta.contador) {
                UIkit.notification({
                    message: resposta.cpf,
                    status: 'danger',
                    pos: 'bottom-right',
                    timeout: 5000
                });
            }
            if (resposta.id) {
                location.href="index.php?id="+resposta.id
            }
        })
    }
}
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
var url_string = window.location.href;
var url = new URL(url_string);
var id = url.searchParams.get("id");
document.getElementById('idusuario').setAttribute('value',id)
var dadoscliente = new Vue({
    el:'#content',
    data:{
        clientes:""
    },
    methods:{
        foto:function(){
            
        }
    }
})
$.get( "rotas/verificacadastro.php?id="+id, function(dados) {
    if (dados.quantidade) {
        $.get( "rotas/selecionacliente.php?id="+id, function(dados) {
            dadoscliente.clientes = dados.cliente;
            document.querySelector('.cadastrocompleto').classList.remove('uk-hidden')
            document.querySelector('.precadastros').classList.add('uk-hidden')
        },'json')
    }else{
        document.querySelector('.cadastrocompleto').classList.add('uk-hidden')
        document.querySelector('.precadastros').classList.remove('uk-hidden')
    }
}, 'json')

    document.getElementById('clientecadastra').addEventListener('submit',(e)=>{
        e.preventDefault()
        let dado = new FormData(this.document.getElementById('clientecadastra'))
        $.ajax({
            url: 'rotas/cadastrocliente.php',
            type: 'post',
            dataType: 'json',
            data: dado,
            contentType: false,
            cache: false,
            processData: false,
        }).done((resposta) => {
            if (!resposta.condicao && window.innerWidth > 960) {
                UIkit.notification({
                    message: resposta.mensagem,
                    status: 'danger',
                    pos: 'bottom-right',
                    timeout: 5000
                });
                cadastroprodutosinput.forEach((element,index) => {
                    if(element.name === resposta.posisao){
                        element.classList.add('uk-form-danger')
                        element.focus();
                    }
                });
            }else if(!resposta.condicao && window.innerWidth < 960){
                UIkit.notification({
                    message: resposta.mensagem,
                    status: 'danger',
                    pos: 'top-center',
                    timeout: 5000
                });
                cadastroprodutosinput.forEach((element,index) => {
                    if(element.name === resposta.posisao){
                        element.classList.toggle('uk-form-danger')
                    }
                });
            }
            if (resposta.condicao && window.innerWidth > 960) {
                UIkit.notification({
                    message: resposta.mensagem,
                    status: 'success',
                    pos: 'bottom-right',
                    timeout: 5000
                });
                setTimeout(() => {
                    location.href="pagamento.php?id="+id
                }, 6000);
            }
        })
    })
    var bar = document.getElementById('js-progressbar');
    UIkit.upload('.js-upload', {

        url: 'rotas/cadastrocliente.php',
        multiple: true,
        type:"POST",
        name:"file[]",
        allow : '*.(jpg|jpeg|gif|png)',
        concurrent:2,
        type:"json",
        error: function () {
            console.log('error', arguments);
        },
        complete: function (environment) {
            var{response}=environment;
            document.querySelector('#foto').setAttribute('value',response.fotos)
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
    function login(e) {
        e.preventDefault()
        let dado = new FormData(e.target)
        $.ajax({
            url: 'rotas/login.php',
            type: 'post',
            dataType: 'json',
            data: dado,
            contentType: false,
            cache: false,
            processData: false,
        }).done((resposta) => {
            if(resposta.corfimacao){
                location.href="index.php?id="+resposta.cliente.id
            }
        })
    }
