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


Route::get('/', 'CursosController@create');
Route::resource('alunos','AlunoController',['except' => ['show','destroy']]);
Route::resource('cursos','CursosController',['except' => ['show','destroy']]);
Route::resource('matriculas','MatriculasController',['except' => ['show','destroy']]);
Route::post('matriculas/buscar', 'MatriculasController@buscar');
Route::post('matriculas/cancelar/{id}', 'MatriculasController@cancelar');
Route::post('matriculas/pagamento/{id}', 'MatriculasController@pagamento');
Route::post('matriculas/troco/{valorInscricao}', 'MatriculasController@getTroco');
