<?php

namespace App\Http\Controllers;

use App\Helper\UserHelper;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class ReciboPagamento extends Controller
{

    public function relatorioRecibosPagamento(Request $request){
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'RelatorioReciboPagamento';

        return view('view.RelatorioReciboPagamento',compact('response','page','permission'));
    }
}
