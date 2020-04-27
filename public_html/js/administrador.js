var andamentonegocio = new Vue({
    el:'#informacao-andamento',
    data:{
        clientes:0,
        vendas:0,
        entregas:0
    }
})
function datanegoio() {
    var data = new Date();
    var dia  = data.getDate();
    var mes  = data.getMonth()+1;
    var ano  = data.getFullYear();
    let datacerta = dia+'/'+mes+'/'+ano
    return datacerta
}

function buscanegocio() {
    let data = datanegoio();
    $.get( "rotas/trazeprodutosdatas.php?dataclientequantidade="+data, function(dados) {
       if (dados.quantidade) {
           this.andamentonegocio.clientes = dados.quantidade;
       }
    },'json');
    $.get( "rotas/trazeprodutosdatas.php?vendasauto="+data, function(dados) {
        if (dados.quantidade) {
            this.andamentonegocio.vendas = dados.quantidade;
        }
    },'json');
    $.get( "rotas/trazeprodutosdatas.php?entregaauto="+data, function(dados) {
        if (dados.quantidade) {
            this.andamentonegocio.entregas = dados.quantidade;
        }
    },'json');
}
buscanegocio();

var entregasandamentos = new Vue({
    el:'#entregas',
    data:{
        quantidade:""
    }
})

function buscaentrega() {
    $.get( "rotas/trazeprodutosdatas.php?confirmada=off&cancelada=ok", function(dados) {
        if (dados.contador) {
            this.entregasandamentos.quantidade= dados.dadostabela
        }
    },'json');
}
buscaentrega()

var produtostabela = new Vue({
    el:'#produtos',
    data:{
        quantidade:0,
        novoquantidade:[]
    },
    methods:{
        fotos:function(parametos){
            let foto = parametos.substring(3);
            return foto
        },
        tipo:function(parametos){
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
              ];
            if (valor.indexOf(parametos) !== -1) {
                return true;
            }else{
                return false;
            }
        }
    },
    filters:{
        fotos:function(value){
            if (value) {
                return value.substring(3);
            }else{
                return "images/tarja_vermelha.jpg"
            }
        }
    }
})

function tabelaprodutos(parametos) {
    
    $.get( "rotas/trazeprodutosdatas.php?"+parametos, function(dados) {
        if (dados.quantidade) {
            produtostabela.quantidade = dados.medicamento
        }else{
            produtostabela.quantidade = 0
        }
    },'json');
}
tabelaprodutos('menorpreco=ASC')
document.getElementById('ord').addEventListener('change',(e)=>{
    let valor;
    if (e.target.value === "ok") {
       valor = 'maisvendido='+e.target.value;
    }
    if (e.target.value === 'menorpreco') {
        valor = 'menorpreco=ASC';
    }
    if (e.target.value === 'maiorpreco') {
        valor = 'maiorpreco=DESC';
    }
    if (e.target.value === 'nomeaz') {
        valor = 'nomeaz=ASC';
    }
    if (e.target.value === 'nomeza') {
        valor = 'nomeaz=DESC';
    }
    tabelaprodutos(valor);
})

function TabelaProdutos() {
    var quantidade
    document.getElementById('quantidadepagina').addEventListener('change',(e)=>{
        quantidade = e.target.value
    })
    // get the table element
    var $table = document.getElementById("myTable"),
    // number of rows per page
    $n = quantidade,
    // number of rows of the table
    $rowCount = $table.rows.length,
    // get the first cell's tag name (in the first row)
    $firstRow = $table.rows[0].firstElementChild.tagName,
    // boolean var to check if table has a head row
    $hasHead = ($firstRow === "TH"),
    // an array to hold each row
    $tr = [],
    // loop counters, to start count from rows[1] (2nd row) if the first row has a head tag
    $i,$ii,$j = ($hasHead)?1:0,
    // holds the first row if it has a (<TH>) & nothing if (<TD>)
    $th = ($hasHead?$table.rows[(0)].outerHTML:"");
    // count the number of pages
    var $pageCount = Math.ceil($rowCount / $n);
    // if we had one page only, then we have nothing to do ..
    if ($pageCount > 1) {
        // assign each row outHTML (tag name & innerHTML) to the array
        for ($i = $j,$ii = 0; $i < $rowCount; $i++, $ii++)
            $tr[$ii] = $table.rows[$i].outerHTML;
        // create a div block to hold the buttons
        $table.insertAdjacentHTML("afterend","<div id='buttons'></div");
        // the first sort, default page is the first one
        sort(1);
    }

    // ($p) is the selected page number. it will be generated when a user clicks a button
    function sort($p) {
        /* create ($rows) a variable to hold the group of rows
        ** to be displayed on the selected page,
        ** ($s) the start point .. the first row in each page, Do The Math
        */
        var $rows = $th,$s = (($n * $p)-$n);
        for ($i = $s; $i < ($s+$n) && $i < $tr.length; $i++)
            $rows += $tr[$i];
        
        // now the table has a processed group of rows ..
        $table.innerHTML = $rows;
        // create the pagination buttons
        document.getElementById("buttons").innerHTML = pageButtons($pageCount,$p);
        // CSS Stuff
        document.getElementById("id"+$p).setAttribute("class","active");
    }


    // ($pCount) : number of pages,($cur) : current page, the selected one ..
    function pageButtons($pCount,$cur) {
        /* this variables will disable the "Prev" button on 1st page
        and "next" button on the last one */
        var $prevDis = ($cur == 1)?"disabled":"",
            $nextDis = ($cur == $pCount)?"disabled":"",
            /* this ($buttons) will hold every single button needed
            ** it will creates each button and sets the onclick attribute
            ** to the "sort" function with a special ($p) number..
            */
            $buttons = "<input type='button' value='&lt;&lt; Anterior' onclick='sort("+($cur - 1)+")' "+$prevDis+">";
        for ($i=1; $i<=$pCount;$i++)
            $buttons += "<input type='button' id='id"+$i+"'value='"+$i+"' onclick='sort("+$i+")'>";
            $buttons += "<input type='button' value='Proximo &gt;&gt;' onclick='sort("+($cur + 1)+")' "+$nextDis+">";
        return $buttons;
    }
}
TabelaProdutos()

function entregas() {
    var quantidade
    document.getElementById('quantidadepagina').addEventListener('change',(e)=>{
        quantidade = e.target.value
    })
    // get the table element
    var $table = document.getElementById("entregatabela"),
    // number of rows per page
    $n = quantidade,
    // number of rows of the table
    $rowCount = $table.rows.length,
    // get the first cell's tag name (in the first row)
    $firstRow = $table.rows[0].firstElementChild.tagName,
    // boolean var to check if table has a head row
    $hasHead = ($firstRow === "TH"),
    // an array to hold each row
    $tr = [],
    // loop counters, to start count from rows[1] (2nd row) if the first row has a head tag
    $i,$ii,$j = ($hasHead)?1:0,
    // holds the first row if it has a (<TH>) & nothing if (<TD>)
    $th = ($hasHead?$table.rows[(0)].outerHTML:"");
    // count the number of pages
    var $pageCount = Math.ceil($rowCount / $n);
    // if we had one page only, then we have nothing to do ..
    if ($pageCount > 1) {
        // assign each row outHTML (tag name & innerHTML) to the array
        for ($i = $j,$ii = 0; $i < $rowCount; $i++, $ii++)
            $tr[$ii] = $table.rows[$i].outerHTML;
        // create a div block to hold the buttons
        $table.insertAdjacentHTML("afterend","<div id='buttons'></div");
        // the first sort, default page is the first one
        sort(1);
    }
    // ($p) is the selected page number. it will be generated when a user clicks a button
    function sort($p) {
        /* create ($rows) a variable to hold the group of rows
        ** to be displayed on the selected page,
        ** ($s) the start point .. the first row in each page, Do The Math
        */
        var $rows = $th,$s = (($n * $p)-$n);
        for ($i = $s; $i < ($s+$n) && $i < $tr.length; $i++)
            $rows += $tr[$i];
        
        // now the table has a processed group of rows ..
        $table.innerHTML = $rows;
        // create the pagination buttons
        document.getElementById("buttons").innerHTML = pageButtons($pageCount,$p);
        // CSS Stuff
        document.getElementById("id"+$p).setAttribute("class","active");
    }


    // ($pCount) : number of pages,($cur) : current page, the selected one ..
    function pageButtons($pCount,$cur) {
        /* this variables will disable the "Prev" button on 1st page
        and "next" button on the last one */
        var $prevDis = ($cur == 1)?"disabled":"",
            $nextDis = ($cur == $pCount)?"disabled":"",
            /* this ($buttons) will hold every single button needed
            ** it will creates each button and sets the onclick attribute
            ** to the "sort" function with a special ($p) number..
            */
            $buttons = "<input type='button' value='&lt;&lt; Anterior' onclick='sort("+($cur - 1)+")' "+$prevDis+">";
        for ($i=1; $i<=$pCount;$i++)
            $buttons += "<input type='button' id='id"+$i+"'value='"+$i+"' onclick='sort("+$i+")'>";
            $buttons += "<input type='button' value='Proximo &gt;&gt;' onclick='sort("+($cur + 1)+")' "+$nextDis+">";
        return $buttons;
    }
}
entregas()