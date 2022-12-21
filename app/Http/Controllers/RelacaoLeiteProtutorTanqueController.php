<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\FonteTanque;
use App\Models\Produtor;
use App\Models\RelacaoLeiteProdutorTanque;
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

                DB::beginTransaction();

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

                DB::commit();

                }catch(Exception $e){
                    DB::rollBack();
                    echo 'Erro ao inserir na base comunique ao administrador';
                }

                return back();
            }
            return back();
        }else{
            return back();
        }
    }

    public function destroy(Request $request, $id){
        if(Auth::check()){
            if(UserHelper::hasAdm() || UserHelper::hasFunc()){

                $acaoLeite = TipoAcaoLeite::where('tipo_acao_valor','ENTRADA')->first();
                $leiteProdutorTanque = RelacaoLeiteProdutorTanque::find($id);

                $infoTanqueLeiteAssociacao = DB::table('tanque_leite_associacao')
                                        ->where('relacao_leite_produtor_tanque_id',$id)
                                        ->where('total_leite_acao', $leiteProdutorTanque->qntd_litros_entregue )
                                        ->where('tipo_acao_leite_id',$acaoLeite->id)
                                        ->first();

                $FonteTanque = FonteTanque::find( $infoTanqueLeiteAssociacao->fonte_id);

                DB::beginTransaction();

                try{

                    DB::table('tanque_leite_associacao')
                        ->where('relacao_leite_produtor_tanque_id',$id)
                        ->where('total_leite_acao', $leiteProdutorTanque->qntd_litros_entregue )
                        ->where('tipo_acao_leite_id',$acaoLeite->id)
                        ->delete();

                    $leiteProdutorTanque->delete();

                    DB::table('fonte_tanque')
                    ->where('id',$infoTanqueLeiteAssociacao->fonte_id)
                    ->update(['total_leite'=>$FonteTanque->total_leite-$leiteProdutorTanque->qntd_litros_entregue ]);

                DB::commit();

                }catch(Exception $e){
                    DB::rollBack();
                    echo 'Erro ao inserir na base comunique ao administrador';
                }




                return back();
            }
            return back();
        }else{
            return back();
        }
        return back();

    }



}
