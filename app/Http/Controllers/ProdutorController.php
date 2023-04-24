<?php

namespace App\Http\Controllers;

use App\Entidade\SaldoProdutorEntidade;
use App\Enums\StatusReciboEnum;
use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\Produtor;
use App\Models\ReciboPagamento;
use App\Models\RelacaoLeiteProdutorTanque;
use App\Models\SaldoProdutor;
use App\Models\StatusRecibo;
use App\Models\TipoProdutor;
use App\Models\TipoUsuario;
use App\Repository\IReposirtory;
use App\Repository\ISaldoRepository;
use App\Repository\SaldoProdutorRepository;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdutorController extends Controller
{
    protected $repositorySaldo;

    public function __construct()
    {
        $this->repositorySaldo = new SaldoProdutorRepository();
    }

    public function alterar($id){
        if(Auth::check()){
            if(UserHelper::hasAdm()){
                try{
                    $response = UserHelper::getDataUserLogged();
                    $permission = TipoUsuario::find($response['tipo_usuario_id']);

                    $produtores = DB::table('produtor')
                            ->join('tipo_produtor','produtor.tipo_produtor_id','=','tipo_produtor.id')
                            ->leftjoin('endereco','produtor.id','=','endereco.id')
                            ->select('produtor.id','nome', 'cpf_cnpj','produtor.datahora_inclusao as inclusao','tipo_produtor.desc_valor as tipo',
                                    'produtor.rg','inscricao','produtor.users_id')
                            ->orderBy('id', 'asc')
                            ->get();

                    $indices = [];
                    foreach($produtores as $produtor){
                        if($produtor->users_id != null and $produtor->id != $id){
                            array_push($indices, $produtor->users_id);
                        }
                    }

                    $users = DB::table('users')
                                ->join('tipo_usuario','users.tipo_usuario_id','tipo_usuario.id')
                                ->whereNotIn('users.id', $indices)
                                // ->where('tipo_usuario.tipo_valor','PROD')
                                ->select('users.tipo_usuario_id as id_tipo_user','users.id','name','cpf','email','tipo_usuario_id','tipo_valor','descricao','data_inclusao')
                                ->get();

                    $page['info'] = 'edicaoProdutor';
                    $edit = Produtor::find($id);

                    $tipoProdutores = TipoProdutor::all();


                    return view('view.alteracao.EdicaoProdutor', compact('response','permission','page','edit','produtores','users','tipoProdutores'));
                }catch(Exception $e){
                    return back();
                }
            }
        }else{
            return back();
        }

        return back();
    }

    public function update(Request $request){

        if(Auth::check()){
            if(UserHelper::hasAdm()){

                $produtorOriginal = Produtor::find( $request->input('id'));

                try{

                    DB::table('produtor')
                        ->where('id',$request->input('id'))
                        ->update([
                            'nome' =>empty($request->input('nome'))? $produtorOriginal->nome :  $request->input('nome'),
                            'cpf_cnpj'=> empty($request->input('cpfcnpj'))? $produtorOriginal->cpf_cnpj : $request->input('cpfcnpj'),
                            'rg'=>empty($request->input('identificacao')) ? $produtorOriginal->rg : $request->input('identificacao'),
                            'telefone'=>empty($request->input('telefone'))? $produtorOriginal->telefone : $request->input('telefone'),
                            'data_nascimento'=>empty($request->input('nascimento'))? $produtorOriginal->data_nascimento : $request->input('nascimento'),
                            'tipo_produtor_id'=>(integer) empty($request->input('tipo_produtor'))? $produtorOriginal->tipo_produtor_id : $request->input('tipo_produtor'),
                            'inscricao'=>empty($request->input('inscricao'))? $produtorOriginal->inscricao : $request->input('inscricao'),
                            'datahora_atualizacao'=>new \DateTime(),
                            'usuario'=> UserHelper::getNameUserLogged(),
                            'users_id'=>$request->input('users_id')=='' ? null:(integer)$request->input('users_id'),
                        ]);
                }catch(Exception $e){

                    echo "erro ao inserir na base informe ao desenvolvedor";
                    return redirect('/produtor/formulario')->with('message','Não foi possivel atualizar os dados verifique novamente');
                }

                // return back();
            }
            return redirect()->route('produtorFormulario');
        }else{
            return back();
        }
    }

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
                    ->paginate(10);

        $indices = [];
        foreach($produtores as $produtor){
            if($produtor->users_id != null){
                array_push($indices, $produtor->users_id);
            }
        }

        $users = DB::table('users')
                    ->join('tipo_usuario','users.tipo_usuario_id','tipo_usuario.id')
                    ->whereNotIn('users.id', $indices)
                    // ->where('tipo_usuario.tipo_valor','PROD')
                    ->select('users.tipo_usuario_id as id_tipo_user','users.id','name','cpf','email','tipo_usuario_id','tipo_valor','descricao','data_inclusao')
                    ->get();

        $tipoProdutores = TipoProdutor::all();

        return view('view.cadastroProdutor', compact('response','produtores','page','users','permission','tipoProdutores'));

   }

   public function destroy($id){

        if(Auth::check()){
            if(UserHelper::hasAdm()){
                $saldoProdutor = DB::table('saldo_produtor')
                                    ->where('saldo_produtor.produtor_id',$id)
                                    ->delete();
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

                DB::beginTransaction();


                $saldoProdutor = new SaldoProdutorEntidade();

                try{
                   $idProdutor = DB::table('produtor')->insertGetId([
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

                    $saldoProdutor->setProdutorId($idProdutor);

                    $this->repositorySaldo->create($saldoProdutor);

                    DB::commit();
                }catch(Exception $e){
                    DB::rollBack();
                    echo "erro ao inserir na base informe ao desenvolvedor";
                }

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

        $produtor = DB::table('produtor')
                            ->where('produtor.users_id', $response['id'])
                            ->first();

        if( $produtor != null ){

            $temp['totalLitros'] = 0;
            $temp['valorLeiteMes'] = 0.0;
            $temp['valorAReceber'] = 0.0;

            $statusRecibo = StatusRecibo::where('valor',StatusReciboEnum::GERADO)
                            ->first();

            $reciboPagamento = ReciboPagamento::where('produtor_id', $produtor->id)
                            ->whereBetween('mes_referencia', [ Helpers::dataCorteInicioMesPersonalizado(date('m')), Helpers::dataCorteFimMesPersonalizado(date('m'))])
                            ->where('status_recibo_id', $statusRecibo['id'])
                            ->first();

            $temp['totalLitros'] =  $reciboPagamento!= null ? $reciboPagamento['total_litros_pago'] : 0;

            $valorMensal = DB::table('valor_leite_mensal')
                    ->where('valor_leite_mensal.tipo_produtor_id',$produtor->tipo_produtor_id)
                    ->where('valor_leite_mensal.data_validade', ">=", date("Y-m-d"))
                    // ->whereBetween('data_validade', [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                    ->select('valor_leite_mensal.valor_liquido as valor')
                    ->first();


            $temp['valorLeiteMes'] =    $valorMensal != null ? $valorMensal->valor : 0;

            $temp['valorAReceber'] =  $reciboPagamento!= null ?  $reciboPagamento['valor_pago'] : 0;

            $entregas = DB::table('relacao_leite_produtor_tanque')
                    ->join('produtor','relacao_leite_produtor_tanque.produtor_id','produtor.id')
                    ->join('periodo','relacao_leite_produtor_tanque.periodo_id','periodo.id')
                    ->join('valor_leite_mensal','relacao_leite_produtor_tanque.valor_leite_mensal_id','valor_leite_mensal.id')
                    ->where('relacao_leite_produtor_tanque.produtor_id',$produtor->tipo_produtor_id )
                    ->whereBetween('relacao_leite_produtor_tanque.data_entrega',[ Helpers::dataCorteInicioMesPersonalizado(date('m')), Helpers::dataCorteFimMesPersonalizado(date('m'))] )
                    ->select('relacao_leite_produtor_tanque.id as rlpt_id', 'relacao_leite_produtor_tanque.*', 'produtor.*','periodo.*','valor_leite_mensal.*')
                    ->orderBy('relacao_leite_produtor_tanque.data_entrega', 'DESC')
                    ->paginate(20);


            $DashboardRelatorioLeiteProdutor = $temp;
            $RelatorioLeiteProdutor =  $entregas;
        }



        return view('view.RelatorioLeiteProdutor',compact('response','page','permission','RelatorioLeiteProdutor','DashboardRelatorioLeiteProdutor'));
   }


   public function relatorioLeiteProdutorMensal(Request $request){
    $page['info'] = 'RelatorioLeiteProdutorMensal';
    $response = UserHelper::getDataUserLogged();
    $permission = TipoUsuario::find($response['tipo_usuario_id']);
    $DashboardRelatorioLeiteProdutor = null;
    $RelatorioLeiteProdutor = null;
    $valorMensal = null;

    $produtor = DB::table('produtor')
                        ->where('produtor.users_id', $response['id'])
                        ->first();

    if( $produtor != null ){

        $temp['totalLitros'] = 0;
        $temp['valorLeiteMes'] = 0.0;
        $temp['valorAReceber'] = 0.0;

        $statusRecibo = StatusRecibo::where('valor',StatusReciboEnum::GERADO)
                        ->first();

        $reciboPagamento = ReciboPagamento::where('produtor_id', $produtor->id)
                        ->whereBetween('mes_referencia', [ Helpers::dataCorteInicioMesPersonalizado(date('m')), Helpers::dataCorteFimMesPersonalizado(date('m'))])
                        ->where('status_recibo_id', $statusRecibo['id'])
                        ->first();

        $temp['totalLitros'] =  $reciboPagamento!= null ? $reciboPagamento['total_litros_pago'] : 0;

        $valorMensal = DB::table('valor_leite_mensal')
                ->where('valor_leite_mensal.tipo_produtor_id',$produtor->tipo_produtor_id)
                ->where('valor_leite_mensal.data_validade', ">=", date("Y-m-d"))
                // ->whereBetween('data_validade', [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                ->select('valor_leite_mensal.valor_liquido as valor')
                ->first();


        $temp['valorLeiteMes'] =    $valorMensal != null ? $valorMensal->valor : 0;

        $temp['valorAReceber'] =  $reciboPagamento!= null ?  $reciboPagamento['valor_pago'] : 0;

        $entregas = DB::table('relacao_leite_produtor_tanque')
                ->join('produtor','relacao_leite_produtor_tanque.produtor_id','produtor.id')
                ->join('periodo','relacao_leite_produtor_tanque.periodo_id','periodo.id')
                ->join('valor_leite_mensal','relacao_leite_produtor_tanque.valor_leite_mensal_id','valor_leite_mensal.id')
                ->where('relacao_leite_produtor_tanque.produtor_id',$produtor->tipo_produtor_id )
                ->whereBetween('relacao_leite_produtor_tanque.data_entrega',[ Helpers::dataCorteInicioMesPersonalizado(date('m')), Helpers::dataCorteFimMesPersonalizado(date('m'))] )
                ->select('relacao_leite_produtor_tanque.id as rlpt_id', 'relacao_leite_produtor_tanque.*', 'produtor.*','periodo.*','valor_leite_mensal.*')
                ->orderBy('relacao_leite_produtor_tanque.data_entrega', 'DESC')
                ->paginate(20);


        $DashboardRelatorioLeiteProdutor = $temp;
        $RelatorioLeiteProdutor =  $entregas;
    }



    return view('view.RelatorioLeiteProdutorMensal',compact('response','page','permission','RelatorioLeiteProdutor','DashboardRelatorioLeiteProdutor'));
}

public function relatorioLeiteProdutorMensalPesquisar(Request $request){

        if($request->input('mes_inicio') >= $request->input('mes_fim')){
            return redirect('/produtor/relatorio/leitemensal')->with('message','Data de inicio deve ser maior que data de fim');
        }

        $page['info'] = 'RelatorioLeiteProdutorMensal';
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $reciboPagamento = null;

        $produtor = DB::table('produtor')
                            ->where('produtor.users_id', $response['id'])
                            ->first();

        if( $produtor != null ){

            $reciboPagamento =
                        ReciboPagamento::where('produtor_id', $produtor->id)
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

        if( !isset($reciboPagamento) || $reciboPagamento == null){
            return redirect('/produtor/relatorio/leitemensal')->with('message','Não foi encontrado recibos no intervalo de datas informadas');
        }

        // dd($reciboPagamento );
        return view('view.RelatorioLeiteProdutorMensal',compact('response','page','permission','reciboPagamento'));
    }
}
