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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Actividades/inicio', 'ActividadesController@index')->name('actividades.inicio');
Route::post('/Actividades/guardar', 'ActividadesController@store')->name('actividades.store');
Route::get('/Actividades/{id}/{semana}', 'ActividadesController@destroy')->name('actividades.destroy');
Route::post('/Actividades/enviar', 'ActividadesController@send')->name('actividades.enviar');
Route::post('/Actividades/editar/{id}/{semana}', 'ActividadesController@update')->name('actividades.editar');

Route::get('/vistoBueno/inicio', 'VtoBuenoController@index')->name('vtoBueno.inicio');
Route::post('/vistoBueno/editar', 'VtoBuenoController@update')->name('vtoBueno.editar');
Route::post('/vistoBueno/enviar/{semana}', 'VtoBuenoController@store')->name('vtoBueno.enviar');

Route::get('/Validaciones/inicio', 'ValidacionController@index')->name('validacion.inicio');
Route::post('/Validaciones/enviar', 'ValidacionController@store')->name('validacion.enviar');

Route::get('/plan/inicio', 'PlanSemanalController@index')->name('plan.inicio');
Route::post('/plan/editar/{id}', 'PlanSemanalController@update')->name('plan.editar');
Route::get('/plan/reporte/{ejercicio}/{mes}/{direccion}/{semana}', 'PlanSemanalController@reporteSemanal')->name('planSemanal.reporte');

Route::get('/Registro/inicio', 'RegistroController@index')->name('registro.inicio');
Route::post('/Registro/enviar', 'RegistroController@store')->name('registro.enviar');

Route::get('/Password/inicio', 'PasswordController@index')->name('password.inicio');
Route::post('/Password/enviar', 'PasswordController@store')->name('password.enviar');
