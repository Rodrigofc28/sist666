<?php

/* public routes*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('servicos','HomeController@create')->name('servico');
/* Auth routes */
Auth::routes();

Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

Route::get('unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

/* Admin routes */

Route::post('users/destroy/{user}', 'Admin\UsersController@destroy')->name('users.destroy');
Route::get('admin/laudos/search/{rep}', 'Admin\LaudosController@search')->name('admin.laudos.search');
Route::get('admin/users/search/{nome}', 'Admin\UsersController@search')->name('users.search');
Route::get('admin/laudos', 'Admin\LaudosController@index')->name('admin.laudos.index');
/* Peritos routes */
Route::resource('laudos', 'Perito\LaudosController')->except(['edit']);

Route::get('laudos/search/{rep}', 'Perito\LaudosController@search')->name('laudos.search');

Route::get('laudos/solicitantes/cidade/{cidade_id}',
    'Perito\OrgaosSolicitantesController@filtrar_por_cidade')->name('solicitantes.filtrar');



Route::post('laudos/armas/{arma}/images', 'Perito\ArmasController@store_image')->name('armas.images');
Route::delete('laudos/armas/{arma}/images', 'Perito\ArmasController@delete_image')->name('armas.images.delete');

Route::prefix('')->group(function () { //Route::prefix()->group(function () { o
    
   Route::get('gerar_/{lado}', 'Perito\LaudosController@generate_docx')->name('laudos.generate_docx');
   Route::get('formulario_/', 'Perito\FormularioController@create')->name('laudos.formulario'); 

   Route::post('formulario_/cadastrar/', 'Perito\FormularioController@store')->name('formularios.store'); 
   Route::get('gerar_', 'Perito\FormularioController@generate_docx')->name('formulario.generate_docx');
});


Route::resource('cadastros','CadastrarusuarioController');
Route::post('cadastros.store', 'CadastrarusuarioController@store');
Route::post('/cadastros/{usuario}', 'CadastrarusuarioController@destroy')->name('cadastros.destroy');









