<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['auth', 'usuario']], function () {
    # Home.
    Route::get('home', 'HomeController@index');
    Route::get('/', 'HomeController@index');
    # Adotantes.
    Route::get('adotantes/buscar', 'AdotanteController@buscar');
    Route::resource('adotantes', 'AdotanteController');
    # Adotivos.
    Route::get('adotivos/buscar', 'AdotivoController@buscar');
    Route::resource('adotivos', 'AdotivoController');
    # Usuários.
    Route::get('usuarios/buscar', 'UsuarioController@buscar');
    Route::resource('usuarios', 'UsuarioController');
    # Visitas.
    Route::resource('visitas', 'VisitaController');
    # Relatórios.
    Route::put('relatorio-adotivo', 'RelatorioAdotivoController@gerar');
    Route::resource('relatorio-adotivo',  'RelatorioAdotivoController');
    Route::resource('relatorio-adotante', 'RelatorioAdotanteController');
    Route::resource('relatorio-orfanato', 'RelatorioOrfanatoController');
    # Solicitação Interno.
    Route::get('solicitar-cadastro/analisar/{id}', 'SolicitaCadastroController@analisar');
    Route::put('solicitar-cadastro/aprovar/{id}', 'SolicitaCadastroController@aprovar');
    Route::delete('solicitar-cadastro/reprovar/{id}', 'SolicitaCadastroController@reprovar');
    Route::get('solicitar-cadastro/buscar', 'SolicitaCadastroController@buscar');
    Route::resource('solicitar-cadastro', 'SolicitaCadastroController');
    # Vículos
    Route::patch('vinculos/vincular/', 'VinculoController@vincular'); # PUT is used to create or update.
    Route::put('vinculos/desvincular/', 'VinculoController@desvincular' );
    Route::get('vinculos/adotivo/{adotivo_id}/adotantes/{adotantes_id}',['uses' => 'VinculoController@visualizar']);
    Route::get('vinculos/adotivo/{id}',['uses' => 'VinculoController@index', 'as' => 'listar']);
    // Route::resource('vinculo', 'VinculoController');
    # instituição
    Route::get('instituicao/buscar', 'InstituicaoController@buscar');
    Route::resource('instituicao', 'InstituicaoController');  
});
# Solicitação Externo.
Route::get('solicitar-cadastro/create', 'SolicitaCadastroController@create');
Route::post('solicitar-cadastro', 'SolicitaCadastroController@store');
