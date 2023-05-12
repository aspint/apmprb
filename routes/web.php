<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ClienteEmpresaControler;
use App\Http\Controllers\GeradorRelatoriosPDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutorController;
use App\Http\Controllers\ReciboPagamento;
use App\Http\Controllers\RelacaoLeiteProtutorTanqueController;
use App\Http\Controllers\TanqueLeiteAssociacaoController;
use App\Http\Controllers\ValorLeiteMensalController;

//Rota para site
Route::get('/', function () {
    return redirect('/login');
});

// rota para login
Route::get('/login',function(){
    return view('login');
})->name('login');

// Rota autenticação
Route::post('/auth',[UserController::class,'auth'])->name('auth');

//Rotas usuarios
Route::group(['middleware'=>['auth']], function(){

    Route::get('/home',[HomeController::class,'index'])->name('home');
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::get('/user/formulario',[UserController::class,'edit'])->name('userFormulario');
    Route::post('/user/formulario/inserir',[UserController::class, 'cadastrar'])->name('inserirUsuario');
    Route::post('/user/formulario/excluir',[UserController::class, 'destroy'])->name('excluirUsuario');
    Route::post('/user/formulario/alterar/{id}',[UserController::class, 'alterar'])->name('alterarUsuario');
    Route::post('/user/formulario/atualizaUsuario',[UserController::class, 'atualizaUsuario'])->name('atualizaUsuario');
    Route::get('/back', function(){
        return redirect()->route('userFormulario');
    })->name('backFormulario');

    ROute::get('/user/config/perfil', [UserController::class, 'atualizarUsuarioView'])->name('configPerfil');

});

Route::group(['middleware'=>['auth']], function(){

    //PRODUTOR
    Route::get('/produtor/formulario',[ProdutorController::class,'edit'])->name('produtorFormulario');
    Route::delete('/produtor/formulario/excluir/{id}',[ProdutorController::class,'destroy'])->name('excluirProdutor');
    Route::post('/produtor/formuario/criar',[ProdutorController::class, 'store'])->name('criarProdutor');
    Route::post('/produtor/formulario/alterar/{id}',[ProdutorController::class, 'alterar'])->name('alterarProdutor');
    Route::post('/produtor/formulario/atualizarprodutor',[ProdutorController::class, 'update'])->name('atualizarProdutor');
    Route::get('/produtor/relatorio/leitediario',[ProdutorController::class, 'relatorioLeiteProdutorDiario'])->name('RelatorioLeiteProdutorDiario');
    Route::get('/produtor/relatorio/leitemensal',[ProdutorController::class, 'relatorioLeiteProdutorMensal'])->name('RelatorioLeiteProdutorMensal');
    Route::post('/produtor/relatorio/leitemensal/pesquisar',[ProdutorController::class, 'relatorioLeiteProdutorMensalPesquisar'])->name('RelatorioLeiteProdutorMensalPesquisar');
    Route::get('/produtor/cadastro/leitediario',[AppController::class,'create'])->name('CadastroLeiteProdutor');
    Route::get('/produtor/back', function(){
        return redirect()->route('produtorFormulario');
    })->name('backFormularioProdutor');

    //LEITE
    Route::post('/produtor/cadastro/leitediario/inserir',[RelacaoLeiteProtutorTanqueController::class,'store'])->name('inserirLeiteProdutor');
    Route::delete('/produtor/cadastro/leitediario/destroy/{id}',[RelacaoLeiteProtutorTanqueController::class,'destroy'])->name('excluirLeiteProdutor');
    Route::get('/leite/cadastro/valor',[ValorLeiteMensalController::class,'create'])->name('CadastroValorLeite');
    Route::post('/leite/cadastro/valor/inserir',[ValorLeiteMensalController::class,'store'])->name('inserirValorLeiteMensal');
    Route::delete('/leite/cadastro/valor/excluir',[ValorLeiteMensalController::class, 'destroy'])->name('excluirValorLeiteMensal');
    Route::get('/fonte/formulario',[TanqueLeiteAssociacaoController::class,'index'])->name('formularioCadastroFonte');
    Route::post('/fonte/formulario/inserir',[TanqueLeiteAssociacaoController::class,'create'])->name('criarTanqueFonte');
    Route::delete('/fonte/formulario/excluir/{id}',[TanqueLeiteAssociacaoController::class,'destroy'])->name('excluirFonte');
    Route::get('/cliente/cadastro/leite-saida',[AppController::class,'saidaLeite'])->name('CadastroLeiteSaida');
    Route::post('/cliente/cadastro/leite-saida/inserir',[AppController::class,'inserirSaidaLeiteCliente'])->name('inserirLeiteCliente');

    //CLIENTE
    Route::get('/cliente/formulario',[ClienteEmpresaControler::class,'create'])->name('formularioCadastroCliente');
    Route::post('/cliente/formulario/inserir-cliente',[ClienteEmpresaControler::class,'store'])->name('formularioCadastroClienteInserir');
    Route::delete('/cliente/formulario/destroy/{id}',[ClienteEmpresaControler::class,'destroy'])->name('excluirCliente');

    //RELATORIO
    Route::get('/produtor/relatorio/leitediario/gerarPDF',[GeradorRelatoriosPDFController::class,'gerarRelatorioLeiteMensalPDF'])->name('produtorFormularioToPdf');
    Route::post('/produtor/relatorio/leitemensal/pesquisar/gerarPDF',[GeradorRelatoriosPDFController::class, 'gerarRelatorioLeiteMensalPDFEspecifico'])->name('GerarPDFRelatorioLeiteProdutorMensalPesquisar');

    //PAGAMENTO
    Route::get('/produtor/relatorio/recibos-pagamento',[ReciboPagamento::class, 'relatorioRecibosPagamento'])->name('RelatorioRecibosPagamento');


});

