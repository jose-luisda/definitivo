@extends('headerfooter.tamplede')
@section('titulo','AmapaFarmaPopular')
@section('conteudo')
<div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
         
          <!-- =====  BREADCRUMB END===== -->
          <div class="category-page-wrapper mb_30">
            <div class="col-xs-6 sort-wrapper">
              <label class="control-label" for="input-sort">Busca:</label>
              <div class="sort-inner">
                <select id="input-sort" class="form-control">
                  <option value="nome ASC" selected="selected">Padrão</option>
                  <option value="nome ASC">Nome (A - Z)</option>
                  <option value="nome DESC">Nome (Z - A)</option>
                  <option value="preco ASC">Preço (Menor &gt; Maior)</option>
                  <option value="preco DESC">Preço (Maior &gt; Menor)</option>
                </select>
              </div>
              <span><i class="fa fa-angle-down" aria-hidden="true"></i></span> </div>
            <div class="col-xs-4 page-wrapper">
              <label class="control-label" for="input-limit">Quantidade :</label>
              <div class="limit">
                <select id="input-limit" class="form-control">
                  <option value="8" selected="selected">08</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </select>
              </div>
              <span><i class="fa fa-angle-down" aria-hidden="true"></i></span> </div>
            <div class="col-xs-2 text-right list-grid-wrapper">
              <div class="btn-group btn-list-grid">
                <button type="button" id="list-view" class="btn btn-default list-view"></button>
                <button type="button" id="grid-view" class="btn btn-default grid-view active"></button>
              </div>
            </div>
          </div>
          <div class="row">
         @if(count($produtos)>=1)
          @foreach($produtos as $key => $produto)    
            <div class="product-layout product-grid col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="item">
                <div class="product-thumb clearfix mb_30">
                @if($produto->foto)
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="{{url('$produto->foto')}}" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="{{url('$produto->foto')}}" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                @else
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="{{url('images/product/tarja_vermelha.jpg')}}" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="{{url('images/product/tarja_vermelha.jpg')}}" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                @endif
                  <div class="caption product-detail text-left">
                  @if(isset($id))
                    <h6 data-name="product_name" class="product-name mt_20"><a href="{{ route('perfilproduto',[$produto->id,$id]) }}" title="Casual Shirt With Ruffle Hem">{{$produto->nome}}  {{$produto->tipo}}</a></h6>
                  @else
                  <h6 data-name="product_name" class="product-name mt_20"><a href="{{ route('perfil',$produto->id) }}" title="Casual E Shirt With Ruffle Hem">{{$produto->nome}}  {{$produto->tipo}}</a></h6>
                  @endif
                    <span class="price"><span class="amount"><span class="currencySymbol">R$</span>{{number_format(($produto->preco - ($produto->preco * ($produto->desconto /100))), 2, ',', ' ')}}</span>
                    </span>
                    @if(isset($id))
                    <button class="uk-button  uk-width-1-1 uk-margin-small-bottom" onclick="CestaSalva({{$produto->id}},{{$produto->preco}},1,{{$produto->desconto}},{{$id}})"> Adicionar</button>
                    @else
                    <button class="uk-button  uk-width-1-1 uk-margin-small-bottom" onclick="CestaSalva({{$produto->id}},{{$produto->preco}},1,{{$produto->desconto}},'')"> Adicionar</button>
                    @endif
                    <button class="uk-button  uk-width-1-1 uk-margin-small-bottom">Comprar</button>
                    <p class="product-desc mt_20 mb_60"> {{$produto->nome}}  {{$produto->tipo}}</p>
                   
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        
          </div>
          <div class="pagination-nav text-center mt_50">
            <ul>
              <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul>
          </div>
          @else
          <div class="uk-alert-danger">
              <p  class='uk-padding-small'>
               Não exister produtos nesta categoria.
              </p>
          </div>
          @endif
        </div>
    
      
@endsection
       