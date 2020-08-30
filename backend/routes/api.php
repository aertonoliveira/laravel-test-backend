<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::post('/imovel', 'ImovelController@store');
Route::get('/imovel', 'ImovelController@index');
Route::get('/imoveis', 'ImovelController@countImoveis');
Route::get('/imovel/nao_associado', 'ImovelController@imoveisNaoAssociados');
Route::delete('/imovel/{id}', 'ImovelController@destroy');



Route::get('/estado', 'EstadoController@index');
Route::get('/estado/cidade/{id}', 'CidadeController@index');

Route::post('/contrato', 'ContratoController@store');
Route::get('/contrato', 'ContratoController@index');
Route::get('/contratos', 'ContratoController@countContratos');
Route::delete('/contrato/{id}', 'ContratoController@destroy');
