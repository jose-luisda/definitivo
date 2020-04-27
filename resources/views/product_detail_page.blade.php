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
  <link rel="shortcut icon" href="{{url('images/icones.png')}}">
  <link rel="apple-touch-icon" href="{{url('images/apple-touch-icon.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{url('images/apple-touch-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{url('images/apple-touch-icon-114x114.png')}}">
  <link rel="stylesheet" href="{{url('css/uikit.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />   
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
                @else
                  <li class="account"><a href="{{ route('login') }}">Minha conta</a></li>
                  <li class="cart"><a href="{{ route('login') }}">Meu carrinho</a></li>
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
                @if(isset($produtos))
                <div class="cart-item " data-target="#cart-dropdown" data-toggle="collapse" aria-expanded="true" role="button">Item's : <span class="cart-qty" id="cartqty">{{count($produtos)}}</span></div>
                @endif
                <div id="cart-dropdown" class="cart-menu collapse">
                  <ul>
                    <li>
                      <table class="table table-striped">
                        <tbody id="cesta">
                        @if(isset($produtos))
                          @foreach($produtos as $cestas)
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
                    <form role="search" id="searchform" action="/search" method="get">
                      <label class="h5 normal search-input-label">O que você procura?</label>
                      <input value="" name="q" placeholder="Escreva aqui..." type="search">
                      <button type="submit"></button>
                    </form>
                    <!-- End Search Form -->
                  </div>
                </div>
                <div class="header-search"> <a id="search-overlay-btn"></a> </div>
              </div>
            </div>
            <div class="collapse navbar-collapse js-navbar-collapse pull-right">
              <ul id="menu" class="nav navbar-nav">
                <li> <a href="index.html">Inicio</a></li>
                <li> <a href="category_page.html">Fazer compra</a></li>
                <li> <a href="blog_page.html">Blog</a></li>
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
                    <li> <a href="cart_page.html">Carrinho</a></li>
                    <li> <a href="checkout_page.html">Confira</a></li>
                    <li> <a href="product_detail_page.html">Perfil do produtos</a></li>
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
              <ul class="nav  main-navigation collapse in ">
                <li><a href="#">Medicamento</a></li>
                <li><a href="#">Generico</a></li>
                    <li><a href="#">Saúde</a></li>
                    <li><a href="#">Beleza</a></li>
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
      <div id="brand_carouse" class="ptb_30 text-center">
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
      </div>
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
              <li><a href="#">Medicamentos</a></li>
              <li><a href="#">Cuidados de saúde</a></li>
              <li><a href="#">Mãe e bebê</a></li>
              <li><a href="#">Vitaminas</a></li>
              <li><a href="#">Artigos de higiene pessoal</a></li>
              <li><a href="#">Cuidados com a pele</a></li>
            </ul>
          </div>
          <div class="col-md-2 footer-block">
            <h6 class="footer-title ptb_20">Emformação</h6>
            <ul>
              <li><a href="contact.html">Especiais</a></li>
              <li><a href="#">Novos Produtos</a></li>
              <li><a href="#">Mais vendidos
              </a></li>
              <li><a href="#">Nossas lojas</a></li>
              <li><a href="#">Contate-Nos</a></li>
              <li><a href="#">Sobre nós</a></li>
            </ul>
          </div>
          <div class="col-md-2 footer-block">
            <h6 class="footer-title ptb_20">Minha conta</h6>
            <ul>
              <li><a href="#">Confira</a></li>
              <li><a href="#">Minha conta</a></li>
              <li><a href="#">minhas ordens</a></li>
              <li><a href="#">Meus recibos de crédito</a></li>
              <li><a href="#">Meus endereços
              </a></li>
              <li><a href="#">Minha informação pessoal</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h6 class="ptb_20">RECEBA NOVIDADE DE PROMOÇÕES NO SEU EMAIL</h6>
            <p class="mt_10 mb_20">For get offers from our favorite brands & get 20% off for next </p>
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
  <a id="scrollup">Scroll</a>
  <script src="{{url('js/jQuery_v3.1.1.min.js')}}"></script>
  <script>
    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });
    var url_string = window.location.href;
    var url = new URL(url_string);
    localStorage.setItem('id', $('[name="id"]').val())
    let id = localStorage.getItem('id')
    $('[name="id"]').val(id)
    
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
</body>

</html>