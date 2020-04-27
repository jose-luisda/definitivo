var cadastroprodutosinput=document.querySelectorAll('.validate')
var cadastroprodutos = document.getElementById('cadastroprodutos')
cadastroprodutos.addEventListener('submit',(e)=>{
    e.preventDefault();
    let dado = new FormData(this.document.getElementById('cadastroprodutos'))
    $.ajax({
        url: 'rotas/cadastroprodutos.php',
        type: 'post',
        dataType: 'json',
        data: dado,
        contentType: false,
        cache: false,
        processData: false,
    }).done((resposta) => {
        if (resposta.posisao && window.innerWidth > 960) {
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
        }else if(resposta.posisao && window.innerWidth < 960){
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
        if (!resposta.posisao && window.innerWidth > 960) {
            UIkit.notification({
                message: resposta.mensagem,
                status: 'success',
                pos: 'bottom-right',
                timeout: 5000
            });
            cadastroprodutosinput.forEach((element,index) => {
                if(element.name === resposta.posisao){
                    element.classList.remove('uk-form-danger')
                }
            });
        }
    })
  })
  document.getElementById('tipo').addEventListener('change',(e)=>{
      let valor = [
        'Antibióticos', 
        'Anti-inflamatórios', 
        'Analgésicos', 
        'Antipiréticos', 
        'Antiulceroso', 
        'Antialérgico', 
        'Antiemético', 
        'Anti-hipertensivo', 
        'Antidiabéticos', 
        'Antifúngicos', 
        'Vermífugos', 
        'Antigripais', 
        'Antiparasitários', 
        'Xaropes'
      ]
      
      if (valor.indexOf(e.target.value) !== -1) {
          document.querySelector('.dropzone').id = 'cadastroprodutos'
          document.getElementById('basic-form').classList.remove('uk-hidden')
          document.getElementById('produtos').name='cadastroprodutos';
          document.getElementById('botaoenvia').classList.add('uk-hidden')
      }else{
        document.querySelector('.dropzone').id = 'cadastroproduto'
        document.getElementById('basic-form').classList.add('uk-hidden')
        document.getElementById('produtos').name='cadastroproduto'
        document.getElementById('botaoenvia').classList.remove('uk-hidden')
        document.getElementById('cadastroproduto').addEventListener('submit',()=>{
            e.preventDefault();
            let dado = new FormData(this.document.getElementById('cadastroproduto'))
            $.ajax({
                url: 'rotas/cadastroprodutos.php',
                type: 'post',
                dataType: 'json',
                data: dado,
                contentType: false,
                cache: false,
                processData: false,
            }).done((resposta) => {
                if (resposta.posisao && window.innerWidth > 960) {
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
                }else if(resposta.posisao && window.innerWidth < 960){
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
                if (!resposta.posisao && window.innerWidth > 960) {
                    UIkit.notification({
                        message: resposta.mensagem,
                        status: 'success',
                        pos: 'bottom-right',
                        timeout: 5000
                    });
                    cadastroprodutosinput.forEach((element,index) => {
                        if(element.name === resposta.posisao){
                            element.classList.remove('uk-form-danger')
                        }
                    });
                }
            })
        })
      }
  })

 


  var bar = document.getElementById('js-progressbar');

    UIkit.upload('.js-upload', {

        url: 'rotas/cadastroprodutos.php',
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
$(document).ready(function()
{
$("#fileuploader").uploadFile({
url: "rotas/cadastroprodutos.php", // Server URL which handles File uploads
fileName:"myfile"
});
});