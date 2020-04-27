
 for (let index = 0; index < $('.form-control').length; index++) {
    $('.form-control').eq(index).change(()=>{
        if(index === 0){
            let dados = $('.form-control').eq(index).val().split(" ");
            let numero = $('.form-control').eq(1).val()
            let id = $('#id').val()
            location.href = url.origin+"/produtos/ordem/"+dados[0]+"/"+dados[1]+'/'+numero+'/'+id
        }else{
            let dados = $('.form-control').eq(0).val().split(" ");
            let numero = $('.form-control').eq(index).val()
            let id = $('#id').val()
            location.href = url.origin+"/produtos/ordem/"+dados[0]+"/"+dados[1]+'/'+numero+'/'+id
        }
    })
 }

