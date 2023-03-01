<?php

namespace App\Http\Controllers;

use App\Helper\UserHelper;
use App\Entidade\SaldoProdutorEntidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaldoProdutorController extends Controller
{
    // index – Lista os dados da tabela
    // show – Mostra um item específco
    // store – Salva o novo item na tabela
    // update – Salva a atualização do dado
    // destroy – Remove o dado

    public function __construct()
    {
        $this->middleware('auth');
    }

}
