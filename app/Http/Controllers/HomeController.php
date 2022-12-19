<?php

namespace App\Http\Controllers;

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

            $DataCorteInicio = Date('01'.'/'.Date('m').'/'.Date('Y'));
            $DataCorteFim = Date(Date("t", mktime(0,0,0,Date('m'),'01',Date('Y'))).'/'.Date('m').'/'.Date('Y'));

            $FonteTanqueLeite = FonteTanque::find(1);
            $Leite = DB::table('relacao_leite_produtor_tanque')
                                ->where('data_entrega','>=', $DataCorteInicio )
                                ->where('data_entrega','<=', $DataCorteFim )
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
