<?php

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

Route::get('/', 'ProdutosController@index');
Route::get('/home', 'ProdutosController@index');

Route::get('/contato', function(){
   return view('contact');
});

Route::resource('/produtos','ProdutosController');
Route::post('/produtos/buscar','ProdutosController@buscar');

Auth::routes();




