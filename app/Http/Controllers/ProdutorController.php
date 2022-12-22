<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\Produtor;
use App\Models\RelacaoLeiteProdutorTanque;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdutorController extends Controller
{


   public function edit(){
    $page['info'] = 'produtor';

    $response = UserHelper::getDataUserLogged();
    $permission = TipoUsuario::find($response['tipo_usuario_id']);

    $produtores = DB::table('produtor')
                ->join('tipo_produtor','produtor.tipo_produtor_id','=','tipo_produtor.id')
                ->leftjoin('endereco','produtor.id','=','endereco.id')
                ->select('produtor.id','nome', 'cpf_cnpj','produtor.datahora_inclusao as inclusao','tipo_produtor.desc_valor as tipo',
                         'produtor.rg','inscricao','produtor.users_id')
                ->orderBy('id', 'asc')
                ->paginate(5);

    $indices = [];
    foreach($produtores as $produtor){
        if($produtor->users_id != null){
            array_push($indices, $produtor->users_id);
        }
    }

    $users = DB::table('users')
                ->join('tipo_usuario','users.tipo_usuario_id','tipo_usuario.id')
                ->whereNotIn('users.id', $indices)
                ->where('tipo_usuario.tipo_valor','PROD')
                ->get();

    return view('view.cadastroProdutor', compact('response','produtores','page','users','permission'));

   }

   public function destroy($id){

    if(Auth::check()){
        if(UserHelper::hasAdm()){
            $produtor = Produtor::find($id);
            $produtor->delete();
            return back();
        }
        return back();
    }else{
        return back();
    }
    return back();
   }

   public function store(Request $request){

        if(Auth::check()){
            if(UserHelper::hasAdm()){

                DB::table('produtor')->insert([
                    'nome' =>  $request->input('nome'),
                    'cpf_cnpj' => $request->input('cpfcnpj'),
                    'rg' => $request->input('identificacao'),
                    'telefone' =>  $request->input('telefone'),
                    'data_nascimento' => $request->input('nascimento'),
                    'tipo_produtor_id' => (integer) $request->input('tipo_produtor'),
                    'inscricao' =>$request->input('inscricao'),
                    'datahora_inclusao' => new \DateTime(),
                    'datahora_atualizacao' => new \DateTime(),
                    'usuario' => UserHelper::getNameUserLogged(),
                    'users_id' => $request->input('usuario')=='' ? null:(integer)$request->input('usuario'),
                ]);

                return back();
            }
            return back();
        }else{
            return back();
        }
   }

   public function relatorioLeiteProdutorDiario(Request $request){
        $page['info'] = 'relatorioLeiteProdutor';
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $DashboardRelatorioLeiteProdutor = null;
        $RelatorioLeiteProdutor = null;
        $valorMensal = null;
        $produtor = null;


        if($permission->tipo_valor == 'PROD'){

            $temp['totalLitros'] = 0;
            $temp['valorLeiteMes'] = 0.0;
            $temp['valorAReceber'] = 0.0;

            $produtor = DB::table('produtor')
                            ->where('produtor.users_id', $response['id'])
                            ->first();

            $resRelacaoProdTanque = DB::table('relacao_leite_produtor_tanque')
                                        // ->join('produtor','relacao_leite_produtor_tanque.produtor_id','produtor.id')
                                        ->where('relacao_leite_produtor_tanque.produtor_id',$produtor->id)
                                        ->whereBetween('data_entrega',  [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                                        ->get();

            foreach($resRelacaoProdTanque as $rlp){
                $temp['totalLitros'] += $rlp->qntd_litros_entregue;
            }

            $valorMensal = DB::table('valor_leite_mensal')
                    ->where('valor_leite_mensal.tipo_produtor_id',$produtor->tipo_produtor_id)
                    ->whereBetween('data_referencia', [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                    ->select('valor_leite_mensal.valor_liquido as valor')
                    ->first();

            $temp['valorLeiteMes'] =  $valorMensal->valor;

            $temp['valorAReceber'] = $valorMensal->valor * $temp['totalLitros'] ;

            $entregas = DB::table('relacao_leite_produtor_tanque')
                    ->join('produtor','relacao_leite_produtor_tanque.produtor_id','produtor.id')
                    ->join('periodo','relacao_leite_produtor_tanque.periodo_id','periodo.id')
                    ->join('valor_leite_mensal','relacao_leite_produtor_tanque.valor_leite_mensal_id','valor_leite_mensal.id')
                    ->where('relacao_leite_produtor_tanque.produtor_id',$produtor->tipo_produtor_id )
                    ->select('relacao_leite_produtor_tanque.id as rlpt_id', 'relacao_leite_produtor_tanque.*', 'produtor.*','periodo.*','valor_leite_mensal.*')
                    ->orderBy('relacao_leite_produtor_tanque.data_entrega', 'DESC')
                    ->paginate(20);


            $DashboardRelatorioLeiteProdutor = $temp;
            $RelatorioLeiteProdutor =  $entregas;
        }



        return view('view.RelatorioLeiteProdutor',compact('response','page','permission','RelatorioLeiteProdutor','DashboardRelatorioLeiteProdutor'));
   }


}
