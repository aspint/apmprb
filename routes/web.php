<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutorController;
use App\Http\Controllers\RelacaoLeiteProtutorTanqueController;
use App\Http\Controllers\ValorLeiteMensalController;

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
    Route::post('/user/formulario/alterar/{id}',[UserController::class, 'alterar'])->name('alterarUsuario');
    Route::post('/user/formulario/atualizaUsuario',[UserController::class, 'atualizaUsuario'])->name('atualizaUsuario');

});

Route::group(['middleware'=>['auth']], function(){

    Route::get('/produtor/formulario',[ProdutorController::class,'edit'])->name('produtorFormulario');
    Route::delete('/produtor/formulario/excluir/{id}',[ProdutorController::class,'destroy'])->name('excluirProdutor');
    Route::post('/produtor/formuario/criar',[ProdutorController::class, 'store'])->name('criarProdutor');
    Route::get('/produtor/relatorio/leitediario',[ProdutorController::class, 'relatorioLeiteProdutorDiario'])->name('RelatorioLeiteProdutorContent');
    Route::get('/produtor/cadastro/leitediario',[AppController::class,'create'])->name('CadastroLeiteProdutor');
    Route::post('/produtor/cadastro/leitediario/inserir',[RelacaoLeiteProtutorTanqueController::class,'store'])->name('inserirLeiteProdutor');
    Route::delete('/produtor/cadastro/leitediario/destroy/{id}',[RelacaoLeiteProtutorTanqueController::class,'destroy'])->name('excluirLeiteProdutor');



    Route::get('/leite/cadastro/valor',[ValorLeiteMensalController::class,'create'])->name('CadastroValorLeite');
    Route::post('/leite/cadastro/valor/inserir',[ValorLeiteMensalController::class,'store'])->name('inserirValorLeiteMensal');
    Route::delete('/leite/cadastro/valor/excluir',[ValorLeiteMensalController::class, 'destroy'])->name('excluirValorLeiteMensal');

});

