<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});


Route::get('/login',function(){
    return view('login');
})->name('login');

Route::post('/auth',[UserController::class,'auth'])->name('auth');

Route::group(['middleware'=>['auth']], function(){

    Route::get('/home',[HomeController::class,'index'])->name('home');
    Route::get('/logout',[UserController::class,'logout'])->name('logout');


    Route::get('/user/formulario',[UserController::class,'edit'])->name('userFormulario');

    Route::post('/user/formulario/inserir',[UserController::class, 'cadastrar'])->name('inserirUsuario');
    Route::post('/user/formulario/excluir',[UserController::class, 'destroy'])->name('excluirUsuario');

});

