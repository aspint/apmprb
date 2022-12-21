<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\FonteTanque;
use App\Models\Periodo;
use App\Models\Produtor;
use App\Models\TipoUsuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    // index – Lista os dados da tabela
    // show – Mostra um item específco
    // create – Retorna a View para criar um item da tabela
    // store – Salva o novo item na tabela
    // edit – Retorna a View para edição do dado
    // update – Salva a atualização do dado
    // destroy – Remove o dado


    public function create(){
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'app';

        $periodos = Periodo::all();
        $produtores = Produtor::all();
        $fonteTanques = FonteTanque::all();

        $valorMensal = DB::table('valor_leite_mensal')
                        ->whereBetween('data_referencia', [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                        ->count();

        if($valorMensal >= 2){
            $page['formulario'] = false;
            $page['message'] = '';

        }else{
            $page['formulario'] = true;
            $page['message'] = 'Não possui valor do leite mensal cadastrado, peça ao administrador que cadadstre para preencher a data de entrega';
        }

        $entregas = DB::table('relacao_leite_produtor_tanque')
                       ->join('produtor','relacao_leite_produtor_tanque.produtor_id','produtor.id')
                       ->join('periodo','relacao_leite_produtor_tanque.periodo_id','periodo.id')
                       ->join('valor_leite_mensal','relacao_leite_produtor_tanque.valor_leite_mensal_id','valor_leite_mensal.id')
                       ->orderBy('relacao_leite_produtor_tanque.data_entrega', 'DESC')
                       ->paginate(10);;


        return view('view.CadastroLeiteProdutor', compact('response','permission','page','periodos','produtores','fonteTanques','entregas'));
    }

}
