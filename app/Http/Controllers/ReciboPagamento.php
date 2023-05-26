<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\ReciboPagamento as ModelsReciboPagamento;
use App\Models\RelacaoLeiteProdutorTanque;
use App\Models\StatusPagamento;
use App\Models\TipoUsuario;
use DateTime;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ReciboPagamento extends Controller
{

    public function relatorioRecibosPagamento(Request $request){
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'RelatorioReciboPagamento';

        return view('view.RelatorioReciboPagamento',compact('response','page','permission'));
    }

    public function relatorioReciboProdutorPesquisar(Request $request){
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'RelatorioReciboPagamento';
        $reciboPagamento = null;

        $produtor = DB::table('produtor')
            ->where('produtor.users_id', $response['id'])
            ->first();

        if( $produtor != null ){
            $reciboPagamento =
                ModelsReciboPagamento::where('produtor_id', $produtor->id)
                            ->join('status_recibo', 'status_recibo.id','recibo_pagamento.status_recibo_id')
                            ->join('status_pagamento', 'status_pagamento.id','recibo_pagamento.status_pagamento_id')
                            ->whereBetween('mes_referencia', [ $request->input('mes_inicio').'-01', $request->input('mes_fim').'-'.Helpers::ultimoDiaMes($request->input('mes_fim'))])
                            ->select(
                                'recibo_pagamento.id',
                                'recibo_pagamento.valor_pago',
                                'recibo_pagamento.total_litros_pago',
                                'recibo_pagamento.periodo_inicio',
                                'recibo_pagamento.periodo_fim',
                                'recibo_pagamento.mes_referencia',
                                'recibo_pagamento.produtor_id',
                                'recibo_pagamento.status_pagamento_id',
                                'status_pagamento.valor as status_pagamento_valor',
                                'status_pagamento.descricao as status_pagamento_descricao',
                                'recibo_pagamento.datahora_inclusao',
                                'recibo_pagamento.datahora_atualizacao',
                                'recibo_pagamento.status_recibo_id',
                                'status_recibo.valor as status_recibo_valor',
                                'status_recibo.descricao as  status_recibo_descricao',
                                'recibo_pagamento.usuario')
                            ->orderBy('recibo_pagamento.mes_referencia', 'DESC')
                            ->paginate(20);
        }

        return view('view.RelatorioReciboPagamento',compact('response','page','permission','reciboPagamento'));
    }

    public function appRecibosPagamento(Request $request){
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'AppReciboPagamento';
        $agora = new DateTime();

        $reciboPagamento =
            ModelsReciboPagamento::
                        join('status_recibo', 'status_recibo.id','recibo_pagamento.status_recibo_id')
                        ->join('status_pagamento', 'status_pagamento.id','recibo_pagamento.status_pagamento_id')
                        ->join('produtor','recibo_pagamento.produtor_id','produtor.id')
                        ->whereBetween('mes_referencia', [date('d/m/Y', strtotime("now -6 month")),date('d/m/Y',strtotime("now"))])
                        ->select(
                            'recibo_pagamento.id',
                            'recibo_pagamento.valor_pago',
                            'recibo_pagamento.total_litros_pago',
                            'recibo_pagamento.periodo_inicio',
                            'recibo_pagamento.periodo_fim',
                            'recibo_pagamento.mes_referencia',
                            'recibo_pagamento.produtor_id',
                            'recibo_pagamento.status_pagamento_id',
                            'status_pagamento.valor as status_pagamento_valor',
                            'status_pagamento.descricao as status_pagamento_descricao',
                            'recibo_pagamento.datahora_inclusao',
                            'recibo_pagamento.datahora_atualizacao',
                            'recibo_pagamento.status_recibo_id',
                            'status_recibo.valor as status_recibo_valor',
                            'status_recibo.descricao as  status_recibo_descricao',
                            'recibo_pagamento.usuario',
                            'produtor.nome',
                            'produtor.inscricao',
                            'produtor.cpf_cnpj')
                        ->orderBy('status_pagamento.id', 'DESC')
                        ->orderBy('recibo_pagamento.mes_referencia', 'DESC')
                        ->paginate(20);


        return view('view.AppReciboPagamento',compact('response','page','permission','reciboPagamento'));
    }


    public function baixarPagamento(Request $request){
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'AppReciboPagamento';
        $agora = new DateTime();

        $status_pagamento = StatusPagamento::where('valor','PAGO')->get();



        dd('DESENVOLVIMENTO');
        // DB::table('relacao_leite_produtor_tanque')
        // ->where('id',$request->input('id'))
        // ->update([
        //     'nome' =>empty($request->input('nome'))? $produtorOriginal->nome :  $request->input('nome'),
        //     'cpf_cnpj'=> empty($request->input('cpfcnpj'))? $produtorOriginal->cpf_cnpj : $request->input('cpfcnpj'),
        //     'rg'=>empty($request->input('identificacao')) ? $produtorOriginal->rg : $request->input('identificacao'),
        //     'telefone'=>empty($request->input('telefone'))? $produtorOriginal->telefone : $request->input('telefone'),
        //     'data_nascimento'=>empty($request->input('nascimento'))? $produtorOriginal->data_nascimento : $request->input('nascimento'),
        //     'tipo_produtor_id'=>(integer) empty($request->input('tipo_produtor'))? $produtorOriginal->tipo_produtor_id : $request->input('tipo_produtor'),
        //     'inscricao'=>empty($request->input('inscricao'))? $produtorOriginal->inscricao : $request->input('inscricao'),
        //     'datahora_atualizacao'=>new \DateTime(),
        //     'usuario'=> UserHelper::getNameUserLogged(),
        //     'users_id'=>$request->input('users_id')=='' ? null:(integer)$request->input('users_id'),
        // ]);




        $reciboPagamento =
            ModelsReciboPagamento::
                        join('status_recibo', 'status_recibo.id','recibo_pagamento.status_recibo_id')
                        ->join('status_pagamento', 'status_pagamento.id','recibo_pagamento.status_pagamento_id')
                        ->join('produtor','recibo_pagamento.produtor_id','produtor.id')
                        ->whereBetween('mes_referencia', [date('d/m/Y', strtotime("now -6 month")),date('d/m/Y',strtotime("now"))])
                        ->select(
                            'recibo_pagamento.id',
                            'recibo_pagamento.valor_pago',
                            'recibo_pagamento.total_litros_pago',
                            'recibo_pagamento.periodo_inicio',
                            'recibo_pagamento.periodo_fim',
                            'recibo_pagamento.mes_referencia',
                            'recibo_pagamento.produtor_id',
                            'recibo_pagamento.status_pagamento_id',
                            'status_pagamento.valor as status_pagamento_valor',
                            'status_pagamento.descricao as status_pagamento_descricao',
                            'recibo_pagamento.datahora_inclusao',
                            'recibo_pagamento.datahora_atualizacao',
                            'recibo_pagamento.status_recibo_id',
                            'status_recibo.valor as status_recibo_valor',
                            'status_recibo.descricao as  status_recibo_descricao',
                            'recibo_pagamento.usuario',
                            'produtor.nome',
                            'produtor.inscricao',
                            'produtor.cpf_cnpj')
                        ->orderBy('status_pagamento.id', 'DESC')
                        ->orderBy('recibo_pagamento.mes_referencia', 'DESC')
                        ->paginate(20);


        return view('view.AppReciboPagamento',compact('response','page','permission','reciboPagamento'));
    }
}
