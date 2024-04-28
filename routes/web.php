<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CampaniaController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DonadoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudDonacionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::resource('campanias', CampaniaController::class);
Route::resource('solicitudes', SolicitudDonacionController::class);


Auth::routes();

Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/home','http://localhost/donadoresperu/public/principal');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/nuevo', 'App\Http\Controllers\BannerController@nuevo')->name('banner.nuevo');
Route::get('/mapa', 'App\Http\Controllers\BannerController@mapa')->name('banner.mapa');
Route::get('/terminos', 'App\Http\Controllers\BannerController@terminos')->name('banner.terminos');
Route::get('/solicitud', 'App\Http\Controllers\SolicitudController@index')->name('solicitud.index')->middleware('auth');
Route::get('/banner', 'App\Http\Controllers\BannerController@index')->name('banner.index')->middleware('auth');
Route::get('/donadore', 'App\Http\Controllers\DonadoreController@index')->name('donadore.index')->middleware('auth');
Route::get('/actualizar-rol', 'App\Http\Controllers\UserController@index')->name('user.updateRole');


