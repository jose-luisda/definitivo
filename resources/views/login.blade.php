@extends('headerfooter.tamplede')
@section('titulo','Login')
@section('conteudo')
<div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- contact  -->
          <div class="row">
          <div class="col-md-6 col-md-offset-3">
              <div class="panel-login">
                <div class="panel-heading">
                  <div class="row mb_20 ">
                    <div class="col-xs-6">
                      <a href="#" class="" id="login-form-link">Login</a>
                    </div>
                    <div class="col-xs-6">
                      <a href="#" id="register-form-link" class="active">Register</a>
                    </div>
                  </div>
                  <hr>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form id="login-form" action="#" method="post" style="display: none;">
                        <div class="form-group">
                          <input type="email" name="email" id="username1" tabindex="1" class="form-control" placeholder="Email" value="">
                        </div>
                        <div class="form-group">
                          <input type="password" name="senha" id="password" tabindex="2" class="form-control" placeholder="Senha">
                        </div>
                        <div class="form-group text-center">
                          <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                          <label for="remember"> Cadastre</label>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                              <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="text-center">
                                <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <form id="register-form" action="#" method="post" style="display: block;">
                        <div class="form-group">
                          <input type="text" name="nome" id="username" tabindex="1" class="form-control" placeholder="Usuário" value="">
                        </div>
                        <div class="form-group">
                          <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                        </div>
                        <div class="form-group">
                          <input type="text" name="cpf" id="email" tabindex="1" class="form-control" placeholder="Cpf" value="">
                        </div>
                        <div class="form-group">
                          <input type="password" name="senha" id="password2" tabindex="2" class="form-control" placeholder="Senha">
                        </div>
                        
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                              <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Cadastro">
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection