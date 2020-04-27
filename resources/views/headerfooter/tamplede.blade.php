<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="pt-br">
<!--<![endif]-->

<head>
  <!-- =====  BASIC PAGE NEEDS  ===== -->
  <meta charset="utf-8">
  <title>@yield('titulo')</title>
  <!-- =====  SEO MATE  ===== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="distribution" content="global">
  <meta name="revisit-after" content="2 Days">
  <meta name="robots" content="ALL">
  <meta name="rating" content="8 YEARS">
  <meta name="Language" content="en-us">
  <meta name="GOOGLEBOT" content="NOARCHIVE">
  <!-- =====  MOBILE SPECIFICATION  ===== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="viewport" content="width=device-width">
  <!-- =====  CSS  ===== -->
  <link rel="stylesheet" type="text/css" href="{{url('css/font-awesome.min.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('css/magnific-popup.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('css/owl.carousel.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('css/chat.css')}}">
  <link rel="shortcut icon" href="{{url('images/icones.png')}}">
  <link rel="apple-touch-icon" href="{{url('images/apple-touch-icon.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{url('images/apple-touch-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{url('images/apple-touch-icon-114x114.png')}}">
  <link rel="stylesheet" href="{{url('css/uikit.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />   
  <script src="{{url('js/jQuery_v3.1.1.min.js')}}"></script>
</head>

<body class="shop-detail">
  <!-- =====  LODER  ===== -->
  <div class="loder"></div>
  <div class="wrapper">
    <!-- =====  HEADER START  ===== -->
    <header id="header">
      <div class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <ul class="header-top-left">
                <!-- <li class="language dropdown"> <span class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"> <img src="images/English-icon.gif" alt="img"> English <span class="caret"></span> </span>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#"><img src="images/English-icon.gif" alt="img"> English</a></li>
                    <li><a href="#"><img src="images/French-icon.gif" alt="img"> French</a></li>
                    <li><a href="#"><img src="images/German-icon.gif" alt="img"> German</a></li>
                  </ul> 
                </li>
                <li class="currency dropdown"> <span class="dropdown-toggle" id="dropdownMenu12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"> USD <span class="caret"></span> </span>
                   <ul class="dropdown-menu" aria-labelledby="dropdownMenu12">
                    <li><a href="#">USD</a></li>
                    <li><a href="#">EUR</a></li>
                    <li><a href="#">AUD</a></li>
                  </ul>
                </li> -->
              </ul>
            </div>
            <div class="col-sm-6">
              <ul class="header-top-right text-right">
               
                <!-- <li class="sitemap"><a href="#">Sitemap</a></li> -->
                @if(isset($id))
                  <li class="account"><a href="{{ route('historicos',$id) }}">Minha conta</a></li>
                  <li class="cart"><a href="{{ route('cestaindex',$id) }}">Meu carrinho</a></li>
                  <input type="hidden" name="id" id="id" value="{{$id}}"/>
                @else
                  <li class="account"><a href="{{ route('login') }}">Minha conta</a></li>
                  <li class="cart"><a href="{{ route('login') }}">Meu carrinho</a></li>
                  <input type="hidden" name="id" id="id" value="{{rand(10, 1000)}}"/>
                 <?php 
                    echo "<script>
                    if(localStorage.getItem('id')){
                      let id = localStorage.getItem('id')
                      $('#id').val(id)
                    }else{
                      localStorage.setItem('id', $('#id').val())
                      let id = localStorage.getItem('id')
                      $('#id').val(id)
                    }
                    </script>";
                 ?>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="header">
        <div class="container">
          <nav class="navbar">
            <div class="navbar-header mtb_20 "> <a class="navbar-brand"  href="index.html"> <img style='height: 80px'  alt="HealthCared" src="{{url('images/logo_amapa.png')}}" > </a> </div>
            <div class="header-right pull-right mtb_50">
              <button class="navbar-toggle pull-left" type="button" data-toggle="collapse" data-target=".js-navbar-collapse"> <span class="i-bar"><i class="fa fa-bars"></i></span></button>
              <div class="shopping-icon">
                @if(isset($id))
                <div class="cart-item " data-target="#cart-dropdown" data-toggle="collapse" aria-expanded="true" role="button">Item's : <span class="cart-qty" id="cartqty">{{count($cesta)}}</span></div>
                @else
                <div class="cart-item " data-target="#cart-dropdown" data-toggle="collapse" aria-expanded="true" role="button">Item's : <span class="cart-qty" id="cartqty">0</span></div>
                @endif
                <div id="cart-dropdown" class="cart-menu collapse">
                  <ul>
                    <li>
                      <table class="table table-striped">
                        <tbody id="cesta">
                        @if(isset($cesta) &&  count($cesta) >=1)
                          @foreach($cesta as $cestas)
                           <tr>
                           @if($cestas->foto)
                            <td class="text-center"><a href="#"><img src="{{url('$cestas->foto')}}" alt="iPod Classic" title="iPod Classic"></a></td>
                           @else
                           <td class="text-center"><a href="#"><img src="{{url('images/product/tarja_vermelha.jpg')}}" alt="iPod Classic" title="iPod Classic"></a></td>
                           @endif
                            <td class="text-left product-name"><a href="#">{{$cestas->nome}} {{$cestas->tipo}}</a>
                              <span class="text-left price">R$:{{number_format((((($cestas->desconto/100)*$cestas->preco) - $cestas->preco)*(-1)), 2, ',', ' ')}}</span>
                              <input type="hidden" class="ids" value="{{$cestas->id}}">
                              <input type="hidden" class="descontos" value="{{$cestas->desconto}}">
                              <input type="hidden" class="precos" value="{{$cestas->preco}}">
                              <input class="cart-qty cart-qtys" name="product_quantity" min="1" value="{{$cestas->quantidade}}" type="">
                            </td>
                            <td class="text-center"><a class="close-cart"><i class="fa fa-times-circle"></i></a></td>
                          </tr>
                          @endforeach
                        
                        </tbody>
                      </table>
                    </li>
                    <li>
                      <table class="table">
                        <tbody>
                          <tr>
                            <td class="text-right"><strong>Sub-Total</strong></td>
                            <td class="text-right" id="subtotal">R$:{{number_format($cestas->total, 2, ',', ' ')}}</td>
                          </tr>
                          <tr>
                            <td class="text-right"><strong>Desconto (0%)</strong></td>
                            <td class="text-right">R$00,00</td>
                          </tr>
                          <!-- <tr>
                            <td class="text-right"><strong>VAT (20%)</strong></td>
                            <td class="text-right">$20.00</td>
                          </tr> -->
                          <tr>
                            <td class="text-right"><strong>Total</strong></td>
                            <td class="text-right"id="total">R$:{{number_format($cestas->total, 2, ',', ' ')}}</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </li>
                    <li>
                      <form action="cart_page.html">
                        <input class="btn pull-left mt_10" value="Carrinho" type="submit">
                      </form>
                      <form action="checkout_page.html">
                        <input class="btn pull-right mt_10" value="Confira" type="submit">
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="main-search pull-right">
                <div class="search-overlay">
                  <!-- Close Icon -->
                  <a href="javascript:void(0)" class="search-overlay-close"></a>
                  <!-- End Close Icon -->
                  <div class="container">
                    <!-- Search Form -->
                    @if(isset($id))
                    <form role="search" id="searchform" action="{{ route('produtosbusca',$id) }}" method="post">
                    @csrf
                      <label class="h5 normal search-input-label">O que você procura?</label>
                      <input name="q" placeholder="Escreva aqui..." type="search">
                      <button type="submit"></button>
                    </form>
                    @else
                    <form role="search" id="searchform" action="{{ route('produtosbusca') }}" method="post">
                    @csrf
                      <label class="h5 normal search-input-label">O que você procura?</label>
                      <input name="q" placeholder="Escreva aqui..." type="search">
                      <button type="submit"></button>
                    </form>
                    
                    @endif
                    
                    <!-- End Search Form -->
                  </div>
                </div>
                <div class="header-search"> <a id="search-overlay-btn"></a> </div>
              </div>
            </div>
            <div class="collapse navbar-collapse js-navbar-collapse pull-right">
              <ul id="menu" class="nav navbar-nav">
                 @if(isset($id))
                <li> <a href="{{route('produtoshome',$id)}}">Fazer compra</a></li>
                @else
                <li> <a href="{{route('index')}}">Fazer compra</a></li>
                @endif
               
                <!-- <li class="dropdown mega-dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Collection </a> -->
                  <ul class="dropdown-menu mega-dropdown-menu row">
                    <li class="col-md-3">
                      <ul>
                        <li class="dropdown-header">Women's</li>
                        <li><a href="#">Unique Features</a></li>
                        <li><a href="#">Image Responsive</a></li>
                        <li><a href="#">Auto Carousel</a></li>
                        <li><a href="#">Newsletter Form</a></li>
                        <li><a href="#">Four columns</a></li>
                        <li><a href="#">Four columns</a></li>
                        <li><a href="#">Good Typography</a></li>
                      </ul>
                    </li>
                    <li class="col-md-3">
                      <ul>
                        <li class="dropdown-header">Man's</li>
                        <li><a href="#">Unique Features</a></li>
                        <li><a href="#">Image Responsive</a></li>
                        <li><a href="#">Four columns</a></li>
                        <li><a href="#">Auto Carousel</a></li>
                        <li><a href="#">Newsletter Form</a></li>
                        <li><a href="#">Four columns</a></li>
                        <li><a href="#">Good Typography</a></li>
                      </ul>
                    </li>
                    <li class="col-md-3">
                      <ul>
                        <li class="dropdown-header">Children's</li>
                        <li><a href="#">Unique Features</a></li>
                        <li><a href="#">Four columns</a></li>
                        <li><a href="#">Image Responsive</a></li>
                        <li><a href="#">Auto Carousel</a></li>
                        <li><a href="#">Newsletter Form</a></li>
                        <li><a href="#">Four columns</a></li>
                        <li><a href="#">Good Typography</a></li>
                      </ul>
                    </li>
                    <li class="col-md-3">
                      <ul>
                        <li id="myCarousel" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner">
                            <div class="item active"> <a href="#"><img src="{{url('images/menu-banner1.jpg')}}" class="img-responsive" alt="Banner1"></a></div>
                            <!-- End Item -->
                            <div class="item"> <a href="#"><img src="{{url('images/menu-banner2.jpg')}}" class="img-responsive" alt="Banner1"></a></div>
                            <!-- End Item -->
                            <div class="item"> <a href="#"><img src="{{url('images/menu-banner3.jpg')}}" class="img-responsive" alt="Banner1"></a></div>
                            <!-- End Item -->
                          </div>
                          <!-- End Carousel Inner -->
                        </li>
                        <!-- /.carousel -->
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pagina </a>
                  <ul class="dropdown-menu">
                    <li> <a href="contact_us.html">Contato</a></li>
                    @if(isset($id))
                    <li> <a href="{{ route('cestaindex',$id) }}">Carrinho</a></li>
                    @endif
                    <li> <a href="checkout_page.html">Confira</a></li>
                    <!-- <li> <a href="single_blog.html">Single Post</a></li> -->
                  </ul>
                </li>
                <li> <a href="about.html">Sobre nós</a></li>
              </ul>
            </div>
            <!-- /.nav-collapse -->
          </nav>
        </div>
      </div>
      <div class="header-bottom">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-3">
              <div class="category">
                <div class="menu-bar" data-target="#category-menu,#category-menu-responsive" data-toggle="collapse" aria-expanded="true" role="button">
                  <h4 class="category_text">Categoria</h4>
                  <span class="i-bar"><i class="fa fa-bars"></i></span></div>
              </div>
              <div id="category-menu-responsive" class="navbar collapse " aria-expanded="true" style="" role="button">
                <div class="nav-responsive">
                  <ul class="nav  main-navigation collapse in">
                    <li><a href="#">farmacia</a></li>
                    <li><a href="#">Saúde</a></li>
                    <li><a href="#">beleza</a></li>
                    <li><a href="#">Vitaminas</a></li>
                    <li><a href="#">Tosses e resfriados</a></li>
                    <li><a href="#">Perda de cabelo</a></li>
                    <li><a href="#">Perda de peso</a></li>
                    <li><a href="#">Antifúngicos</a></li>
                    <li><a href="#">Alívio da dor</a></li>
                    <li><a href="#">Pare de fumar</a></li>
                    <li><a href="#">Condições da pele</a></li>
                    <li><a href="#">Ofertas</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-9">
              <div class="header-bottom-right offers">
              	<!-- <div class="marquee"><span><i class="fa fa-circle" aria-hidden="true"></i>It's Sexual Health Week!</span>
                  <span><i class="fa fa-circle" aria-hidden="true"></i>Our 5 Tips for a Healthy Summer</span>
                  <span><i class="fa fa-circle" aria-hidden="true"></i>Sugar health at risk?</span>
                  <span><i class="fa fa-circle" aria-hidden="true"></i>The Olay Ranges - What do they do?</span>
                  <span><i class="fa fa-circle" aria-hidden="true"></i>Body fat - what is it and why do we need it?</span>
                  <span><i class="fa fa-circle" aria-hidden="true"></i>Can a pillow help you to lose weight?</span></div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- =====  HEADER END  ===== -->
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <div class="row ">
       <div id="column-left" class="col-sm-4 col-md-4 col-lg-3 ">
          <div id="category-menu" class="navbar collapse mb_40 hidden-sm-down in" aria-expanded="true" style="" role="button">
            <div class="nav-responsive">
              @if(isset($id))
              <ul class="nav  main-navigation collapse in uk-nav-default uk-nav-parent-icon" uk-nav>
              <li class="uk-parent">
                            <a href="#">Alopáticos</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['Antibióticos',$id]) }}">Antibióticos</a></li>
                                <li><a href="{{ route('categoria',['Anti-inflamatórios',$id]) }}"> Anti-inflamatórios</a></li>
                                <li><a href="{{ route('categoria',['Analgésicos',$id]) }}"> Analgésicos</a></li>
                                <li><a href="{{ route('categoria',['Antipiréticos',$id]) }}"> Antipiréticos</a></li>
                                <li><a href="{{ route('categoria',['Antiulceroso',$id]) }}"> Antiulceroso</a></li>
                                <li><a href="{{ route('categoria',['Antialérgico',$id]) }}"> Antialérgico</a></li>
                                <li><a href="{{ route('categoria',['Antiemético',$id]) }}"> Antiemético</a></li>
                                <li><a href="{{ route('categoria',['Anti-hipertensivo',$id]) }}"> Anti-hipertensivo</a></li>
                                <li><a href="{{ route('categoria',['Antidiabéticos',$id]) }}"> Antidiabéticos</a></li>
                                <li><a href="{{ route('categoria',['Antifúngicos',$id]) }}"> Antifúngicos</a></li>
                                <li><a href="{{ route('categoria',['Vermífugos',$id]) }}"> Vermífugos</a></li>
                                <li><a href="{{ route('categoria',['Antigripais',$id]) }}"> Antigripais</a></li>
                                <li><a href="{{ route('categoria',['antiparasitários',$id]) }}"> antiparasitários</a></li>
                                <li><a href="{{ route('categoria',['Xaropes',$id]) }}"> Xaropes</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="">Higiene</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['sabonetes',$id]) }}">sabonetes</a></li>
                                <li><a href="{{ route('categoria',['desodorante',$id]) }}"> desodorante </a></li>
                                <li><a href="{{ route('categoria',['colônias',$id]) }}"> colônias</a></li>
                                <li><a href="{{ route('categoria',['absorventes',$id]) }}">  absorventes</a></li>
                                <li><a href="{{ route('categoria',['shampoo',$id]) }}"> shampoo</a></li>
                                <li><a href="{{ route('categoria',['condicionador',$id]) }}"> condicionador</a></li>
                                <li><a href="{{ route('categoria',['preservativos',$id]) }}"> preservativos</a></li>
                                <li><a href="{{ route('categoria',['aparelho barbear',$id]) }}"> aparelho barbear</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="http://">Diversos</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['revistas',$id]) }}"> revistas</a> </li>
                                <li><a href="{{ route('categoria',['picolés',$id]) }}"> picolés </a></li>
                                <li><a href="{{ route('categoria',['sorvetes',$id]) }}"> sorvetes</a></li>
                                <li><a href="{{ route('categoria',['sandálias',$id]) }}"> sandálias</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="http://">Primeiro socorros</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['Ataduras (tamanhos)',$id]) }}">Ataduras (tamanhos)</a></li>
                                <li><a href="{{ route('categoria',['compressas de gases',$id]) }}"> compressas de gases </a></li>
                                <li><a href="{{ route('categoria',['algodão',$id]) }}"> algodão</a></li>
                                <li><a href="{{ route('categoria',['água oxigenada',$id]) }}"> água oxigenada</a></li>
                                <li><a href="{{ route('categoria',['soro fisiológico',$id]) }}"> soro fisiológico</a></li>
                                <li><a href="{{ route('categoria',['mercúrio',$id]) }}"> mercúrio</a></li>
                                <li><a href="{{ route('categoria',['esparadrapo',$id]) }}"> esparadrapo</a></li>
                                <li><a href="{{ route('categoria',['álcool 70%',$id]) }}"> álcool 70%</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="http://">Infantis</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['shampoo',$id]) }}">shampoo</a></li>
                                <li><a href="{{ route('categoria',['condicionador',$id]) }}"> condicionador</a></li>
                                <li><a href="{{ route('categoria',['colônia',$id]) }}"> colônia</a></li>
                                <li><a href="{{ route('categoria',['pomada assadura',$id]) }}"> pomada assadura</a></li>
                                <li><a href="{{ route('categoria',['hidratante',$id]) }}"> hidratante</a></li>
                                <li><a href="{{ route('categoria',['creme dental',$id]) }}"> creme dental</a></li>
                                <li><a href="{{ route('categoria',['mamadeira',$id]) }}"> mamadeira</a></li>
                                <li><a href="{{ route('categoria',['chuquinha',$id]) }}"> chuquinha</a></li>
                                <li><a href="{{ route('categoria',['chupeta',$id]) }}"> chupeta</a>
                                <li><a href="{{ route('categoria',['protetor seios',$id]) }}"> protetor seios</a></li>
                                <li><a href="{{ route('categoria',['lenço umedecido',$id]) }}"> lenço umedecido</a></li>
                                <li><a href="{{ route('categoria',['fraldas',$id]) }}"> fraldas</a></li>
                                <li><a href="{{ route('categoria',['algodão',$id]) }}"> algodão</a></li>
                                <li><a href="{{ route('categoria',['talco',$id]) }}"> talco</a></li>
                                <li><a href="{{ route('categoria',['cotonete',$id]) }}"> cotonete</a></li>
                            </ul>

                        </li>
              </ul>
              @else
              <ul class="nav  main-navigation collapse in uk-nav-default uk-nav-parent-icon" uk-nav>
              <li class="uk-parent">
                            <a href="#">Alopáticos</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['Antibióticos']) }}">Antibióticos</a></li>
                                <li><a href="{{ route('categoria',['Anti-inflamatórios']) }}"> Anti-inflamatórios</a></li>
                                <li><a href="{{ route('categoria',['Analgésicos']) }}"> Analgésicos</a></li>
                                <li><a href="{{ route('categoria',['Antipiréticos']) }}"> Antipiréticos</a></li>
                                <li><a href="{{ route('categoria',['Antiulceroso']) }}"> Antiulceroso</a></li>
                                <li><a href="{{ route('categoria',['Antialérgico']) }}"> Antialérgico</a></li>
                                <li><a href="{{ route('categoria',['Antiemético']) }}"> Antiemético</a></li>
                                <li><a href="{{ route('categoria',['Anti-hipertensivo']) }}"> Anti-hipertensivo</a></li>
                                <li><a href="{{ route('categoria',['Antidiabéticos']) }}"> Antidiabéticos</a></li>
                                <li><a href="{{ route('categoria',['Antifúngicos']) }}"> Antifúngicos</a></li>
                                <li><a href="{{ route('categoria',['Vermífugos']) }}"> Vermífugos</a></li>
                                <li><a href="{{ route('categoria',['Antigripais']) }}"> Antigripais</a></li>
                                <li><a href="{{ route('categoria',['antiparasitários']) }}"> antiparasitários</a></li>
                                <li><a href="{{ route('categoria',['Xaropes']) }}"> Xaropes</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="">Higiene</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['sabonetes']) }}">sabonetes</a></li>
                                <li><a href="{{ route('categoria',['desodorante']) }}"> desodorante </a></li>
                                <li><a href="{{ route('categoria',['colônias']) }}"> colônias</a></li>
                                <li><a href="{{ route('categoria',['absorventes']) }}">  absorventes</a></li>
                                <li><a href="{{ route('categoria',['shampoo']) }}"> shampoo</a></li>
                                <li><a href="{{ route('categoria',['condicionador']) }}"> condicionador</a></li>
                                <li><a href="{{ route('categoria',['preservativos']) }}"> preservativos</a></li>
                                <li><a href="{{ route('categoria',['aparelho barbear']) }}"> aparelho barbear</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="http://">Diversos</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['revistas']) }}"> revistas</a> </li>
                                <li><a href="{{ route('categoria',['picolés']) }}"> picolés </a></li>
                                <li><a href="{{ route('categoria',['sorvetes']) }}"> sorvetes</a></li>
                                <li><a href="{{ route('categoria',['sandálias']) }}"> sandálias</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="http://">Primeiro socorros</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['Ataduras (tamanhos)']) }}">Ataduras (tamanhos)</a></li>
                                <li><a href="{{ route('categoria',['compressas de gases']) }}"> compressas de gases </a></li>
                                <li><a href="{{ route('categoria',['algodão']) }}"> algodão</a></li>
                                <li><a href="{{ route('categoria',['água oxigenada']) }}"> água oxigenada</a></li>
                                <li><a href="{{ route('categoria',['soro fisiológico']) }}"> soro fisiológico</a></li>
                                <li><a href="{{ route('categoria',['mercúrio']) }}"> mercúrio</a></li>
                                <li><a href="{{ route('categoria',['esparadrapo']) }}"> esparadrapo</a></li>
                                <li><a href="{{ route('categoria',['álcool 70%']) }}"> álcool 70%</a></li>
                            </ul>
                        </li>
                        <li class="uk-parent">
                            <a href="http://">Infantis</a>
                            <ul class="uk-nav-sub">
                                <li><a href="{{ route('categoria',['shampoo']) }}">shampoo</a></li>
                                <li><a href="{{ route('categoria',['condicionador']) }}"> condicionador</a></li>
                                <li><a href="{{ route('categoria',['colônia']) }}"> colônia</a></li>
                                <li><a href="{{ route('categoria',['pomada assadura']) }}"> pomada assadura</a></li>
                                <li><a href="{{ route('categoria',['hidratante']) }}"> hidratante</a></li>
                                <li><a href="{{ route('categoria',['creme dental']) }}"> creme dental</a></li>
                                <li><a href="{{ route('categoria',['mamadeira']) }}"> mamadeira</a></li>
                                <li><a href="{{ route('categoria',['chuquinha']) }}"> chuquinha</a></li>
                                <li><a href="{{ route('categoria',['chupeta']) }}"> chupeta</a>
                                <li><a href="{{ route('categoria',['protetor seios']) }}"> protetor seios</a></li>
                                <li><a href="{{ route('categoria',['lenço umedecido']) }}"> lenço umedecido</a></li>
                                <li><a href="{{ route('categoria',['fraldas']) }}"> fraldas</a></li>
                                <li><a href="{{ route('categoria',['algodão']) }}"> algodão</a></li>
                                <li><a href="{{ route('categoria',['talco']) }}"> talco</a></li>
                                <li><a href="{{ route('categoria',['cotonete']) }}"> cotonete</a></li>
                            </ul>

                        </li>
              </ul>
              @endif
            </div>
          </div>
          <!-- <div class="left_banner left-sidebar-widget mt_30 mb_50"> <a href="#"><img src="images/left1.jpg" alt="Left Banner" class="img-responsive" /></a> </div> -->
          <div class="left-cms left-sidebar-widget mb_50">
            <ul>
              <li>
                <div class="feature-i-left ptb_40">
                  <div class="icon-right Shipping"></div>
                  <h6>Frete gratis</h6>
                  <p>Entrega gratuita em toda Macapá</p>
                </div>
              </li>
              <li>
                <div class="feature-i-left ptb_40">
                  <div class="icon-right Order"></div>
                  <h6>Peça online</h6>
                  <p>Horário: 8:00 - 23:00</p>
                </div>
              </li>
              <li>
                <div class="feature-i-left ptb_40">
                  <div class="icon-right Save"></div>
                  <h6>Compre e Economize</h6>
                  <p>Para todas as especiarias e ervas</p>
                </div>
              </li>
              <li>
                <div class="feature-i-left ptb_40">
                  <div class="icon-right Safe"></div>
                  <h6>Compras seguras</h6>
                  <p>Garantir 100% genuíno</p>
                </div>
              </li>
            </ul>
          </div>
          <!-- <div class="left-special left-sidebar-widget mb_50">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Principais produtos</h2>
            </div>
            <div id="left-special" class="owl-carousel">
              <ul class="row ">
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product4.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product4-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product1.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product1-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product2.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product2-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="row ">
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product3.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product3-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product5.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product5-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product6.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product6-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="row ">
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product7.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product7-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product8.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product8-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product9.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product9-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="row ">
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product10.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product10-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product1.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product1-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
                <li class="item product-layout-left mb_20">
                  <div class="product-list col-xs-4">
                    <div class="product-thumb">
                      <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product2.jpg"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="images/product/product2-1.jpg"> </a> </div>
                    </div>
                  </div>
                  <div class="col-xs-8">
                    <div class="caption product-detail">
                      <h6 class="product-name"><a href="#">Latin literature from 45 BC, making it over old.</a></h6>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">$</span>70.00</span>
                      </span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div> -->
          <!-- <div class="left_banner left-sidebar-widget mb_50"> <a href="#"><img src="images/left2.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
          <div class="Testimonial left-sidebar-widget mb_50">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Comentarios</h2>
            </div>
            <div class="client owl-carousel text-center pt_10">
              <div class="item client-detail">
                <div class="client-avatar"> <img alt="" src="images/user1.jpg"> </div>
                <div class="client-title  mt_30"><strong>joseph Lui</strong></div>
                <div class="client-designation mb_10">php Developer</div>
                <p><i class="fa fa-quote-left" aria-hidden="true"></i>Lorem ipsum dolor sit amet, volumus oporteat his at sea in Rem ipsum dolor sit amet, sea in odio ..</p>
              </div>
              <div class="item client-detail">
                <div class="client-avatar"> <img alt="" src="images/user2.jpg"> </div>
                <div class="client-title  mt_30"><strong>joseph Lui</strong></div>
                <div class="client-designation mb_10">php Developer</div>
                <p><i class="fa fa-quote-left" aria-hidden="true"></i>Lorem ipsum dolor sit amet, volumus oporteat his at sea in Rem ipsum dolor sit amet, sea in odio ..</p>
              </div>
              <div class="item client-detail">
                <div class="client-avatar"> <img alt="" src="images/user3.jpg"> </div>
                <div class="client-title  mt_30"><strong>joseph Lui</strong></div>
                <div class="client-designation mb_10">php Developer</div>
                <p><i class="fa fa-quote-left" aria-hidden="true"></i>Lorem ipsum dolor sit amet, volumus oporteat his at sea in Rem ipsum dolor sit amet, sea in odio ..</p>
              </div>
            </div>
          </div> -->
          <div class="Tags left-sidebar-widget mb_50">
            <div class="heading-part mb_20 ">
              <!-- <h2 class="main_title">Tags</h2> -->
            </div>
            <!-- <ul>
              <li><a href="#">business</a></li>
              <li><a href="#">clean</a></li>
              <li><a href="#">corporate</a></li>
              <li><a href="#">blog</a></li>
              <li><a href="#">creative</a></li>
              <li><a href="#">ecommerce</a></li>
              <li><a href="#">modern</a></li>
              <li><a href="#">portfolio</a></li>
              <li><a href="#">retina</a></li>
              <li><a href="#">multipurpose</a></li>
              <li><a href="#">photography</a></li>
              <li><a href="#">responsive</a></li>
            </ul> -->
          </div>
        </div>
        @yield('conteudo')
      </div>
      <!-- <div id="brand_carouse" class="ptb_30 text-center">
        <div class="type-01">
          <div class="heading-part mb_20 ">
            <h2 class="main_title">Brand Logo</h2>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="brand owl-carousel ptb_20">
                <div class="item text-center"> <a href="#"><img src="images/brand/brand1.png" alt="Disney" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="images/brand/brand2.png" alt="Dell" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="images/brand/brand3.png" alt="Harley" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="images/brand/brand4.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="images/brand/brand5.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="images/brand/brand6.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="images/brand/brand7.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="images/brand/brand8.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="images/brand/brand9.png" alt="Canon" class="img-responsive" /></a> </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>
    <!-- =====  CONTAINER END  ===== -->
    <!-- =====  FOOTER START  ===== -->
    <div class="footer pt_60">
      <div class="container">
        <div class="row">
          <div class="col-md-3 footer-block">
            <div class="content_footercms_right">
              <div class="footer-contact">
                <div class="footer-logo mb_40"> <a href="index.html"> <img src="{{url('images/logo_amapa.png')}}" alt="HealthCare"> </a> </div>
                <ul>
                  <li>B-14 Collins Street West Victoria 2386</li>
                  <li>(+123) 456 789 - (+024) 666 888</li>
                  <li>Contact@yourcompany.com</li>
                </ul>
                <div class="social_icon">
                  <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 footer-block">
            <h6 class="footer-title ptb_20">Categoria</h6>
            <ul>
              <li><a href="#">Alopáticos</a></li>
              <li><a href="#">Higiene</a></li>
              <li><a href="#">Diversos</a></li>
              <li><a href="#">Primeiro socorros</a></li>
              <li><a href="#">Infantis</a></li>
            </ul>
          </div>
          <div class="col-md-2 footer-block">
            <h6 class="footer-title ptb_20">Emformação</h6>
            <ul>
             
              <li><a href="#">Novos Produtos</a></li>
              
              <li><a href="#">Nossas lojas</a></li>
              <li><a href="#">Contate-Nos</a></li>
              <li><a href="#">Sobre nós</a></li>
            </ul>
          </div>
          <div class="col-md-2 footer-block">
            <h6 class="footer-title ptb_20">Minha conta</h6>
            <ul>
              
              <li><a href="#">Minha conta</a></li>
              
              <li><a href="#">Meus endereços
              </a></li>
              <li><a href="#">Minha informação pessoal</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h6 class="ptb_20">RECEBA NOVIDADE DE PROMOÇÕES NO SEU EMAIL</h6>
            <!-- <p class="mt_10 mb_20">For get offers from our favorite brands & get 20% off for next </p> -->
            <div class="form-group">
              <input class="mb_20" type="text" placeholder="Insira o seu endereço de email">
              <button class="btn">Envia</button>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom mt_60 ptb_10">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="copyright-part">@ 2017 All Rights Reserved HealthCare</div>
            </div>
            <div class="col-sm-6">
              <div class="payment-icon text-right">
                <ul>
                  <li><i class="fa fa-cc-paypal "></i></li>
                  <li><i class="fa fa-cc-stripe"></i></li>
                  <li><i class="fa fa-cc-visa"></i></li>
                  <li><i class="fa fa-cc-discover"></i></li>
                  <li><i class="fa fa-cc-mastercard"></i></li>
                  <li><i class="fa fa-cc-amex"></i></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- =====  FOOTER END  ===== -->
  </div>
  <!-- <a id="scrollup">Scroll</a> -->
  <div class="btn-group dropup uk-position-fixed uk-position-small uk-position-bottom-right">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropup
  </button>
  <div class="dropdown-menu uk-padding-remove" uk-dropdown="pos: top-right">
        <strong class="uk-padding-small">
        Nome
        </strong>
        
       <div class=" frame" >
            <ol></ol>
           
        </div>
        <div>
                <div class="msj-rta macro uk-width-1-1 ">                        
                    <div class="text text-r " style="background:whitesmoke !important">
                        <input class="mytext" placeholder="Type a message"/>
                    </div> 

                </div>
                <div class="uk-padding-small uk-margin-small-top">
                            <br>
                            <br>
                            <ul class="uk-grid-small uk-grid uk-margin-small-top" uk-grid="">
                               
                                <li>
                                <div class="js-upload" uk-form-custom>
                                    <input type="file" multiple>
                                    <a class="uk-icon-button uk-icon" href="#" uk-icon="icon: cloud-upload" tabindex="-1"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="cloud-upload"><path fill="none" stroke="#000" stroke-width="1.1" d="M6.5,14.61 L3.75,14.61 C1.96,14.61 0.5,13.17 0.5,11.39 C0.5,9.76 1.72,8.41 3.31,8.2 C3.38,5.31 5.75,3 8.68,3 C11.19,3 13.31,4.71 13.89,7.02 C14.39,6.8 14.93,6.68 15.5,6.68 C17.71,6.68 19.5,8.45 19.5,10.64 C19.5,12.83 17.71,14.6 15.5,14.6 L12.5,14.6"></path><polyline fill="none" stroke="#000" points="7.25 11.75 9.5 9.5 11.75 11.75"></polyline><path fill="none" stroke="#000" d="M9.5,18 L9.5,9.5"></path></svg></a>
                                </div>
                                </li>
                                <li>
                                    <a class="uk-icon-button uk-icon" id="excluircesta" href="#" uk-icon="icon: trash"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="trash"><polyline fill="none" stroke="#000" points="6.5 3 6.5 1.5 13.5 1.5 13.5 3"></polyline><polyline fill="none" stroke="#000" points="4.5 4 4.5 18.5 15.5 18.5 15.5 4"></polyline><rect x="8" y="7" width="1" height="9"></rect><rect x="11" y="7" width="1" height="9"></rect><rect x="2" y="3" width="16" height="1"></rect></svg></a>
                                    items:<span id="itens">0</span>
                                  </li>
                            </ul>
                            <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                </div>                
            </div>
        </div>
  </div>
</div>
  
  <script>
    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });
    var url_string = window.location.href;
    var url = new URL(url_string);
  
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
  </script>
  <script src="{{url('js/owl.carousel.min.js')}}"></script>
  <script src="{{url('js/bootstrap.min.js')}}"></script>
  <script src="{{url('js/jquery.magnific-popup.js')}}"></script>
  <script src="{{url('js/jquery.firstVisitPopup.js')}}"></script>
  <script src="{{url('js/uikit.js')}}"></script>
  <script src="{{url('js/uikit-icons.js')}}"></script>
  <script src="{{url('js/custom.js')}}"></script>
  <script src="{{url('js/cesta.js')}}"></script>
  <script src="{{url('js/perfil.js')}}"></script>
  <script src="{{url('js/cestatabela.js')}}"></script>
  <script src="{{url('js/busca.js')}}"></script>
  <script src="{{url('js/chat.js')}}"></script>
</body>

</html>