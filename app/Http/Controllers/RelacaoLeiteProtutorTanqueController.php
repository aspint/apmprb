<?php

namespace App\Http\Controllers;

use App\Enums\StatusPagamentoEnum;
use App\Enums\StatusReciboEnum;
use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\FonteTanque;
use App\Models\Produtor;
use App\Models\ReciboPagamento;
use App\Models\RelacaoLeiteProdutorTanque;
use App\Models\SaldoProdutor;
use App\Models\StatusPagamento;
use App\Models\StatusRecibo;
use App\Models\TipoAcaoLeite;
use App\Models\ValorLeiteMensal;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class RelacaoLeiteProtutorTanqueController extends Controller
{
    public function create(){

    }

    public function store(Request $request){

        if(Auth::check()){
            if(UserHelper::hasAdm() || UserHelper::hasFunc()){
                $produtor = Produtor::find($request->input('produtor'));
                $mesCorrenteInicio = Helpers::dataCorteInicioMes();
                $mesCorrenteFim =  Helpers::dataCorteFimMes();
                $userLogado = UserHelper::getDataUserLogged()['name'];


                $ValorLeite = ValorLeiteMensal::where('tipo_produtor_id', $produtor->tipo_produtor_id)
                             ->whereBetween('data_referencia', [  $mesCorrenteInicio, $mesCorrenteFim])
                            ->first();

                $statusRecibo = StatusRecibo::where('valor',StatusReciboEnum::GERADO)
                                ->first();

                $statusPagamento = StatusPagamento::where('valor',StatusPagamentoEnum::PENDENTE)
                                ->first();

                $reciboPagamento = ReciboPagamento::where('produtor_id', $produtor->tipo_produtor_id)
                                        ->whereBetween('mes_referencia', [ Helpers::dataCorteInicioMesPersonalizado(date('m')), Helpers::dataCorteFimMesPersonalizado(date('m'))])
                                        ->where('status_recibo_id', $statusRecibo['id'])
                                        ->first();
                $saldoProdutor = SaldoProdutor::where('produtor_id', $produtor->id)
                                ->first();

                $acaoLeite = TipoAcaoLeite::where('tipo_acao_valor','ENTRADA')->first();
                $FonteTanque = FonteTanque::find( $request->input('fonteTanque'));


                // dd( $reciboPagamento );
                DB::beginTransaction();

                try{
                    $valorAReceberProdutor = $ValorLeite['valor_liquido']*$request->input('quantidadeLitros');

                    if ($reciboPagamento == null){

                        $reciboPagamento = ReciboPagamento::insertGetId([
                            'valor_pago' => 0.0,
                            'total_litros_pago' =>0.0,
                            'periodo_inicio' => $mesCorrenteInicio ,
                            'periodo_fim' =>$mesCorrenteFim ,
                            'mes_referencia' =>date('d/m/Y'),
                            'produtor_id' =>$produtor['id'] ,
                            'status_pagamento_id' => $statusPagamento['id'],
                            'datahora_inclusao' =>new \DateTime() ,
                            'datahora_atualizacao' => new \DateTime(),
                            'status_recibo_id' => $statusRecibo['id'] ,
                            'usuario' => $userLogado ,
                        ]);

                        $reciboPagamento = ReciboPagamento::find( $reciboPagamento);
                    }

                    $leiteProdutorTanque =  DB::table('relacao_leite_produtor_tanque')->insertGetId([
                            'data_entrega' =>  $request->input('dataEntrega'),
                            'qntd_litros_entregue' =>$request->input('quantidadeLitros') ,
                            'periodo_id' =>$request->input('periodo'),
                            'produtor_id' => $produtor['id'],
                            'datahora_inclusao' => new \DateTime(),
                            'datahora_alteracao' =>new \DateTime(),
                            'valor_leite_mensal_id' => $ValorLeite['id'] ,
                            'recibo_pagamento_id' =>  $reciboPagamento['id'],
                            'status_pagamento_id' => $statusPagamento['id'],
                            'usuario' =>  $userLogado,
                    ]);


                    DB::table('tanque_leite_associacao')->insert([
                        'fonte_id' =>  $request->input('fonteTanque'),
                        'tipo_acao_leite_id' => $acaoLeite->id,
                        'total_leite_acao' => $request->input('quantidadeLitros'),
                        'relacao_leite_produtor_tanque_id' => $leiteProdutorTanque,
                        'usuario' => $userLogado,
                        'datahora_inclusao' => new \DateTime() ,
                        'datahora_atualizacao' =>  new \DateTime(),
                    ]);

                    DB::table('recibo_pagamento')
                        ->where('id',$reciboPagamento['id'])
                        ->update([
                            'total_litros_pago' =>$reciboPagamento['total_litros_pago']+ $request->input('quantidadeLitros') ,
                            'valor_pago'=> $reciboPagamento['valor_pago']+ $valorAReceberProdutor,
                            'datahora_atualizacao'=>new \DateTime(),
                        ]);
                    
                    DB::table('saldo_produtor')
                        ->where('id', $saldoProdutor->id)
                        ->update([
                            'saldo'=> $saldoProdutor->saldo + $valorAReceberProdutor,
                            'datahora_alteracao'=> new \DateTime(),
                            'usuario'=> $userLogado,
                        ])
                    ;
                    DB::table('fonte_tanque')
                    ->where('id',$request->input('fonteTanque'))
                    ->update(['total_leite'=>$FonteTanque->total_leite+$request->input('quantidadeLitros')]);

                DB::commit();

                }catch(Exception $e){
                    DB::rollBack();
                    dd($e);
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
