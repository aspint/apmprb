<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\FonteTanque;
use App\Models\Produtor;
use App\Models\TipoAcaoLeite;
use App\Models\ValorLeiteMensal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RelacaoLeiteProtutorTanqueController extends Controller
{
    public function create(){

    }

    public function store(Request $request){

        if(Auth::check()){
            if(UserHelper::hasAdm() || UserHelper::hasFunc()){
                $produtor = Produtor::find($request->input('produtor'));


                $ValorLeite = ValorLeiteMensal::where('tipo_produtor_id', $produtor->tipo_produtor_id)
                             ->whereBetween('data_referencia', [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                            // ->where('data_referencia', '>=', $DataCorteInicio )
                            // ->where('data_referencia', '<=', $DataCorteFim )
                            ->first();

                // $ValorLeite = DB::table('valor_leite_mensal')
                //                     ->where( 'valor_leite_mensal.tipo_produtor_id', $produtor->tipo_produtor_id);

                $acaoLeite = TipoAcaoLeite::where('tipo_acao_valor','ENTRADA')->first();
                $FonteTanque = FonteTanque::find( $request->input('fonteTanque'));

                try{



                $leiteProdutorTanque =  DB::table('relacao_leite_produtor_tanque')->insertGetId([
                        'data_entrega' =>  $request->input('dataEntrega'),
                        'qntd_litros_entregue' =>$request->input('quantidadeLitros') ,
                        'periodo_id' =>$request->input('periodo'),
                        'produtor_id' => $request->input('produtor'),
                        'datahora_inclusao' => new \DateTime(),
                        'datahora_atualizacao' =>new \DateTime(),
                        'valor_leite_mensal_id' => $ValorLeite['id'] ,
                        'usuario' => UserHelper::getDataUserLogged()['name'],
                ]);


                DB::table('tanque_leite_associacao')->insert([
                    'fonte_id' =>  $request->input('fonteTanque'),
                    'tipo_acao_leite_id' => $acaoLeite->id,
                    'total_leite_acao' => $request->input('quantidadeLitros'),
                    'relacao_leite_produtor_tanque_id' => $leiteProdutorTanque,
                    'usuario' => UserHelper::getDataUserLogged()['name'],
                    'datahora_inclusao' => new \DateTime() ,
                    'datahora_atualizacao' =>  new \DateTime(),
                ]);

                DB::table('fonte_tanque')
                ->where('id',$request->input('fonteTanque'))
                ->update(['total_leite'=>$FonteTanque->total_leite+$request->input('quantidadeLitros')]);



                }catch(Exception $e){

                    echo 'Erro ao inserir na base comunique ao administrador';
                }

                return back();
            }
            return back();
        }else{
            return back();
        }
    }



}
