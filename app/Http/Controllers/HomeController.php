<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\FonteTanque;
use App\Models\TanqueLeiteAssociacao;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if(Auth::check()){
            $page['info'] = 'home';
            $response = UserHelper::getDataUserLogged();
            $permission = TipoUsuario::find($response['tipo_usuario_id']);

            $FonteTanqueLeite = FonteTanque::find(1);
            $Leite = DB::table('relacao_leite_produtor_tanque')
                                ->whereBetween('data_referencia', [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                                ->select(DB::raw('SUM(qntd_litros_entregue) as recebido'))
                                ->first();

            // dd($Leite->recebido);
            // $dashboard['qntdLeite']= [,,];

            return view('view.home', compact('response','page','permission','FonteTanqueLeite','Leite'));
        }else{
            return view('home');
        }
    }
}
