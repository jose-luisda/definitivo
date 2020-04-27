<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Cliente\ProdutoController@index')->name('index');
Route::get('produtos/home/{id?}','Cliente\ProdutoController@Home')->name('produtoshome');
Route::post('produtos/home/busca/{id?}','Cliente\ProdutoController@Busca')->name('produtosbusca');
Route::get('produtos/ordem/{tipo}/{ordem}/{numero}/{id?}','Cliente\ProdutoController@Ordem');
Route::get('produtos/ordem/preco/{numero}','Cliente\ProdutoController@ClassificaPreco');
Route::get('produtos/perfil/cliente/{idproduto}/{idcliente?}','Cliente\ProdutoController@Perfilproduto')->name('perfilproduto');
Route::get('produtos/perfil/{idproduto}','Cliente\ProdutoController@Perfil')->name('perfil');
Route::get('produtos/perfil/categoria/{tipo}/{id?}','Cliente\ProdutoController@Categoria')->name('categoria');
Route::get('produtos/perfil/categoria/auto/{idproduto}','Cliente\ProdutoController@PerfilAuto');



Route::get('cliente/precadastro','UsuarioController@indexCadastro')->name('indexcadastro');
Route::get('cliente/editar/{id}','UsuarioController@editar');
Route::post('cliente/atualizar','UsuarioController@Atualizar');
Route::post('cliente/cadastro','UsuarioController@PrecadastroCliente');
Route::get('cliente/endereco','EnderecoController@PrecadastroEndereco')->name('endereco');
Route::get('cliente/login','LoginController@index')->name('login');
Route::post('cliente/login/entra','LoginController@Login');
Route::post('cliente/login/sair','LoginController@Sair');
Route::get('cliente/historico/{id}','VendaController@index')->name('historicos');
Route::get('cliente/historico/enditar/{id}','VendaController@AtualizarCadastro')->name('historicosenditar');
Route::get('cliente/historico/senha/{id}','VendaController@IndexSenha')->name('Senha');
Route::post('cliente/senha/enditar','VendaController@UpdateSenha');
Route::get('cliente/historico/pedidos/{id}','VendaController@IndexPedidos')->name('indexpedidos');
Route::get('cliente/pagamento/{id}','VendaController@IndexPagamento')->name('pagamento');
Route::post('cliente/pagamento/pagseguro','PagSeguroController@PagseguroIdSessao');
Route::post('cliente/pagamento/pagseguro/procpag','PagSeguroController@Proc_Pag');

Route::get('cesta/index/{id?}/{ids?}','CestaController@index')->name('cestaindex');
Route::get('cesta/json/{id}','CestaController@indexjson')->name('cestaindexjson');
Route::post('cesta/salva','CestaController@CestaSalva')->name('cestasalva');
Route::get('cesta/deleta/{id}','CestaController@CestaDetela');
Route::post('cesta/atualizar','CestaController@CestaAtualizar');

Route::get('chat/index/{id}','ChatController@index');
Route::post('chat/salva','ChatController@Salva');
Route::get('chat/deleta/{id}','ChatController@Deleta');
Route::post('chat/salva/arquivo','ChatController@Foto');