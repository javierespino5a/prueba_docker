<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
aqui van las rutas para entrar a los controladores
|
*/

/*Route::get('/', function () {
    return view('layouts.app');
});*/

//bloqueo de inicio de sesion
Route::group(['middleware' => ['bloqueo']], function () {
   
        Route::get('/captura_pintura','PinturaController@index_agregar' );

        Route::get('/pintura_tabla','PinturaController@index' );
        Route::get('/pintura_editar/{id}','PinturaController@indexeditar' );
        Route::post('/pintura_editar', 'PinturaController@editar');
        Route::get('/pintura_reporte','PinturaController@reporte' );
        Route::post('/agregar_pintura','PinturaController@agregar' );
        Route::get('/exportar_pintura','PinturaController@exportar' );
        Route::post('/exportar_excel','PinturaController@exportar_excel' );
        Route::group(['middleware' => ['admin']], function () {
            Route::get('/registros','AlimentosController@index' );

    });

//MIXTO
Route::post('/buscar_munloc','PinturaController@buscar' );
Route::post('/buscar_folio','PinturaController@buscar_folio' );


//ruta de tareas

Route::get('/inicio','InicioController@index' );
Route::get('/menu','InicioController@menu' );

//ruta de pintura


//ruta de apoyo alimentario
Route::get('/captura_alimento','AlimentosController@index_agregar' );
Route::get('/editar_r/{id}','AlimentosController@indexeditar' );
Route::post('/editar', 'AlimentosController@editar');
Route::get('/alimentos_reporte','AlimentosController@reporte' );
Route::post('/agregar_alimento','AlimentosController@agregar' );
Route::get('/imprimir_alimento','AlimentosController@reporteimprimir' );
Route::get('/exportar_alimentos','AlimentosController@exportar' );
Route::post('/eliminar_al','AlimentosController@eliminar' );
Route::post('/pag_al','AlimentosController@pag' );
Route::post('/repetidos_alimentos','AlimentosController@repetidos' );

Route::post('/exportar_excel_a','AlimentosController@exportar_excel' );

//ruta de ejemplos y extras
Route::get('/reportes/create','UsuariosController@create' );
Route::post('/reportes', function () {
    return 'Creating a note';
});


//ruta de graficas post
Route::post('/modulos', 'ModulosController@modulos');
Route::post('/visitas', 'GraficasController@visitas');

});

 //rutas de inicio de sesion
 Route::post('/logeo', 'LoginController@ingresar');
 Route::post('/logeos', 'LoginController@cerrarsesion');
 Route::get('/','LoginController@index' );
 Route::get('/imprimir_pintura','PinturaController@reporteimprimir' );