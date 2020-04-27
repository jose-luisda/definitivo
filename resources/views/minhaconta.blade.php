@extends('headerfooter.tamplede')
@section('titulo','Historico de compra')
@section('conteudo')
<ul class="uk-tab-bottom" uk-tab>
    <li class="uk-active"><a class="nav-link active" data-toggle="pill" href="#home">Cadastro</a></li>
    <li><a class="nav-link" data-toggle="pill" href="#menu1">Senha</a></li>
    <li><a href="#">Item</a></li>
</ul>
<div class="col-md-9 tab-content">
    <div class=" tab-pane active " id="home">
        <form id="clientecadastra" method="POST" class="form form-register ng-pristine ng-valid-cep ng-valid-maxlength ng-valid-cpf ng-invalid ng-invalid-br-phone-number ng-valid-minlength ng-valid-email" role="form" data-parsley-validate="" ng-submit="atualizar(cliente)" novalidate="">
            @if(isset($usuario->id))
                <input type="hidden" name="id" id='idusuario' value="{{$usuario->id}}">
            @endif
            <div class="row border rounded">
                <section class=" row form-section col-md-12" ng-if="cliente.tipo == 'PF'">
                    <div class="col-md-12">
                        <h2 class="customer-panel-title"><i class="icon_panel_person"></i> Dados de identificação</h2>
                        <small class="form-alert">Itens marcados com * são obrigatórios.</small>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Nome Completo*</label>
                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-maxlength" name="NomeCompleto" ng-model="cliente.nomeCompleto" maxlength="100" data-parsley-required="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>CPF*</label>
                            @if(isset($usuario->cpf))
                                <input value="{{$usuario->cpf}}" type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-cpf ng-not-empty" readonly="" name="Documento" id="CPF" >
                            @else
                                <input value="" type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-cpf ng-not-empty" name="Documento" id="CPF" >
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data Nascimento*</label>
                            <input  type="text" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ui-br-date-mask="" name="DataNascimento" id="DataNascimento" ng-model="cliente.dataNascimento" data-parsley-required="" data-parsley-date="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Gênero*</label>
                            <select name="Sexo" id="Sexo" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="cliente.genero" data-parsley-required="">
                                <option value="MASCULINO" selected="selected">MASCULINO</option>
                                <option value="FEMININO">FEMININO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Celular*</label>
                            <input type="text" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-br-phone-number ng-not-empty ng-valid-minlength" ui-br-ddd-phone-number-mask="" ng-minlength="10" name="Telefone1" id="Telefone1" ng-model="cliente.telefone1" data-parsley-required="">
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Email*</label>
                            @if(isset($usuario->email))
                                <input value="{{$usuario->email}}" type="email" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-email ng-valid-maxlength" name="Email" ng-model="cliente.email" maxlength="100" data-parsley-required="" data-parsley-group="comum" data-parsley-trigger="focusout" data-parsley-error-message="Email inválido ou já existe" readonly="" data-parsley-type="email">
                            @else
                                <input  type="email" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-email ng-valid-maxlength" name="Email" ng-model="cliente.email" maxlength="100" data-parsley-required="" data-parsley-group="comum" data-parsley-trigger="focusout" data-parsley-error-message="Email inválido ou já existe" data-parsley-type="email">
                            @endif
                        </div>
                    </div>
                </section><!---->
                <!---->
                <section class="form-section col-md-12 row clearfix">
                    <div class="col-md-12">
                        <h1 class="h4"><i class="icon_panel_mapmarker"></i> Meu endereço</h1>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>CEP*</label>
                            <a class="text-sm" href="http://www.buscacep.correios.com.br" rel="external" title="Correios" target="_blank">Não sei meu CEP</a>
                            @if(isset($endereco->cep))
                                <input readonly="" value="{{$endereco->cep}}" type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-cep ng-not-empty" ui-br-cep-mask="" name="CodigoPostal" id="CodigoPostal" ng-model="cliente.codigoPostal" ng-change="consultarCep(cliente.codigoPostal)" data-parsley-required="" data-parsley-minlength="9" data-parsley-minlength-message="campo deve ter 9 caracteres" autocomplete="off" data-parsley-id="6696">
                            @else
                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-cep ng-not-empty" ui-br-cep-mask="" name="CodigoPostal" id="CodigoPostal" ng-model="cliente.codigoPostal" ng-change="consultarCep(cliente.codigoPostal)" data-parsley-required="" data-parsley-minlength="9" data-parsley-minlength-message="campo deve ter 9 caracteres" autocomplete="off" data-parsley-id="6696">
                            @endif
                        <ul class="parsley-errors-list" id="parsley-id-6696"></ul></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Logradouro*</label>
                            @if(isset($endereco->rua))
                                <input value="{{$endereco->rua}}" type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-maxlength ng-not-empty" name="Endereco" id="Endereco" ng-model="cliente.logradouro" data-parsley-required="" maxlength="100" autocomplete="off" ng-disabled="desabilitaLogradouro" data-parsley-id="7078" disabled="disabled">
                            @else
                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-maxlength ng-not-empty" name="Endereco" id="Endereco" ng-model="cliente.logradouro" data-parsley-required="" maxlength="100" autocomplete="off" ng-disabled="desabilitaLogradouro" data-parsley-id="7078" >
                            @endif
                        <ul class="parsley-errors-list" id="parsley-id-7078"></ul></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Número*</label>
                            <input type="text" class="form-control numeric ng-pristine ng-untouched ng-valid ng-valid-maxlength ng-not-empty" name="Numero" id="Numero" ng-model="cliente.numero" data-parsley-required="" data-parsley-type="digits" maxlength="10" autocomplete="off" data-parsley-id="3682">
                        <ul class="parsley-errors-list" id="parsley-id-3682"></ul></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Complemento</label>
                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-maxlength" name="Complemento" id="Complemento" ng-model="cliente.complemento" data-parsley-maxlength="60" maxlength="60" autocomplete="off" data-parsley-id="2711">
                        <ul class="parsley-errors-list" id="parsley-id-2711"></ul></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Referência</label>
                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-maxlength" name="PontoReferencia" id="PontoReferencia" ng-model="cliente.referencia" maxlength="200" autocomplete="off" data-parsley-id="8599">
                        <ul class="parsley-errors-list" id="parsley-id-8599"></ul></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bairro*</label>
                            @if(isset($endereco->bairro))
                                <input value="{{$endereco->bairro}}" type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-maxlength ng-not-empty" name="Bairro" id="Bairro" ng-model="cliente.bairro" data-parsley-required="" maxlength="100" autocomplete="off" ng-disabled="desabilitaBairro" data-parsley-id="1518" disabled="disabled">
                            @else
                                <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-maxlength ng-not-empty" name="Bairro" id="Bairro" ng-model="cliente.bairro" data-parsley-required="" maxlength="100" autocomplete="off" ng-disabled="desabilitaBairro" data-parsley-id="1518" >
                            @endif
                        <ul class="parsley-errors-list" id="parsley-id-1518"></ul></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cidade*</label>
                            @if(isset($endereco->cidade))
                                <input value="{{$endereco->cidade}}" type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-maxlength ng-not-empty" name="Cidade" id="Cidade" ng-model="cliente.cidade" data-parsley-required="" maxlength="100" autocomplete="off" ng-disabled="desabilitaCidade" data-parsley-id="8329" disabled="disabled">
                            @else
                            <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-maxlength ng-not-empty" name="Cidade" id="Cidade" ng-model="cliente.cidade" data-parsley-required="" maxlength="100" autocomplete="off" ng-disabled="desabilitaCidade" data-parsley-id="8329">
                            @endif
                            <ul class="parsley-errors-list" id="parsley-id-8329"></ul></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Estado*</label>
                            @if(isset($endereco->estado))
                            <select class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" name="sel-Uf" id="Uf" ng-model="cliente.uf" data-parsley-required="" autocomplete="off" ng-disabled="desabilitaUF" data-parsley-id="2362" disabled="disabled">
                                    
                                    <option value="">- SELECIONE -</option>
                                    <option value="AC">ACRE</option>
                                    <option value="AL">ALAGOAS</option>
                                    <option value="AP">AMAPÁ</option>
                                    <option value="AM">AMAZONAS</option>
                                    <option value="BA">BAHIA</option>
                                    <option value="CE">CEARÁ</option>
                                    <option value="DF">DISTRITO FEDERAL</option>
                                    <option value="ES">ESPIRÍTO SANTO</option>
                                    <option value="GO">GOIÁS</option>
                                    <option value="MA">MARANHÃO</option>
                                    <option value="MT">MATO GROSSO</option>
                                    <option value="MS">MATO GROSSO DO SUL</option>
                                    <option value="MG">MINAS GERAIS</option>
                                    <option value="PA">PARÁ</option>
                                    <option value="PB">PARAÍBA</option>
                                    <option value="PR">PARANÁ</option>
                                    <option value="PE">PERNAMBUCO</option>
                                    <option value="PI">PIAUÍ</option>
                                    <option value="RJ">RIO DE JANEIRO</option>
                                    <option value="RN">RIO GRANDE DO NORTE</option>
                                    <option value="RS">RIO GRANDE DO SUL</option>
                                    <option value="RO">RONDÔNIA</option>
                                    <option value="RR">RORAÍMA</option>
                                    <option value="SC">SANTA CATARINA</option>
                                    <option value="SP">SÃO PAULO</option>
                                    <option value="SE">SERGIPE</option>
                                    <option value="TO">TOCANTINS</option>
                            </select>
                            
                            <?php echo"<script> 
                                    
                                    document.querySelectorAll('#Uf option').forEach(element => {
                                        if(element.value === '$endereco->estado'){
                                            element.setAttribute('selected','selected');
                                        }
                                    })
                            </script>"; ?>
                            @else
                            <select class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" name="sel-Uf" id="Uf" ng-model="cliente.uf" data-parsley-required="" autocomplete="off" ng-disabled="desabilitaUF" data-parsley-id="2362">
                                    
                                    <option value="">- SELECIONE -</option>
                                    <option value="AC">ACRE</option>
                                    <option value="AL">ALAGOAS</option>
                                    <option value="AP">AMAPÁ</option>
                                    <option value="AM">AMAZONAS</option>
                                    <option value="BA">BAHIA</option>
                                    <option value="CE">CEARÁ</option>
                                    <option value="DF">DISTRITO FEDERAL</option>
                                    <option value="ES">ESPIRÍTO SANTO</option>
                                    <option value="GO">GOIÁS</option>
                                    <option value="MA">MARANHÃO</option>
                                    <option value="MT">MATO GROSSO</option>
                                    <option value="MS">MATO GROSSO DO SUL</option>
                                    <option value="MG">MINAS GERAIS</option>
                                    <option value="PA">PARÁ</option>
                                    <option value="PB">PARAÍBA</option>
                                    <option value="PR">PARANÁ</option>
                                    <option value="PE">PERNAMBUCO</option>
                                    <option value="PI">PIAUÍ</option>
                                    <option value="RJ">RIO DE JANEIRO</option>
                                    <option value="RN">RIO GRANDE DO NORTE</option>
                                    <option value="RS">RIO GRANDE DO SUL</option>
                                    <option value="RO">RONDÔNIA</option>
                                    <option value="RR">RORAÍMA</option>
                                    <option value="SC">SANTA CATARINA</option>
                                    <option value="SP">SÃO PAULO</option>
                                    <option value="SE">SERGIPE</option>
                                    <option value="TO">TOCANTINS</option>
                            </select>
                            @endif
                            <input type="hidden" value="AP" name="Uf" autocomplete="off">
                        <ul class="parsley-errors-list" id="parsley-id-2362"></ul></div>
                    </div>
                </section>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-group form-group-btn">
                        <button class="btn btn-primary btn-submit title-login" type="submit">
                            <i class="glyphicon glyphicon-edit"></i>&nbsp;Alterar cadastro
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" id="menu1">
                    <h2 class="customer-panel-title">Alterar Senha</h2>
                    <form id="alterar-senha" method="POST" class="form form-change-password ng-pristine ng-valid ng-valid-maxlength" role="form" data-parsley-validate=""  novalidate="">
                        <input type="hidden" name="id" id='idusuario' value="{{$usuario->id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Senha atual*</label>
                                    <input name="SenhaAtual" type="password" class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-maxlength" id="pwd" ng-model="dados.senhaAtual" data-parsley-required="" maxlength="30" data-parsley-id="5717">
                                <ul class="parsley-errors-list" id="parsley-id-5717"></ul></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nova senha*</label>
                                    <input name="SenhaNova" type="password" class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-maxlength" id="new-pwd" ng-model="dados.novaSenha" data-parsley-required="" maxlength="30" data-parsley-id="1218">
                                <ul class="parsley-errors-list" id="parsley-id-1218"></ul></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Confirme a nova senha*</label>
                                    <input name="ConfirmaSenha" type="password" class="form-control ng-pristine ng-untouched ng-valid ng-empty ng-valid-maxlength" id="new-pwd-confirm" ng-model="dados.confirmarSenha" data-parsley-required="" maxlength="30" data-parsley-equalto="#new-pwd" data-parsley-id="8169">
                                <ul class="parsley-errors-list" id="parsley-id-8169"></ul></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <div class="form-group form-group-btn">
                                    <button class="btn btn-primary btn-submit title-login" type="submit">
                                        <i class="glyphicon glyphicon-edit"></i>&nbsp;Alterar senha
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
</div>
@endsection