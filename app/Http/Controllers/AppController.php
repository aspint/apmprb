<?php

namespace App\Http\Controllers;

use App\Enums\StatusPagamentoEnum;
use App\Enums\StatusReciboEnum;
use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\FonteTanque;
use App\Models\Periodo;
use App\Models\Produtor;
use App\Models\SaldoProdutor;
use App\Models\StatusPagamento;
use App\Models\StatusRecibo;
use App\Models\TipoAcaoLeite;
use App\Models\TipoProdutor;
use App\Models\TipoUsuario;
use App\Models\ValorLeiteMensal;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $page['info'] = 'CadastroLeiteProdutor';

        $periodos = Periodo::all();
        $fonteTanques = FonteTanque::all();

        $valorLeiteMensal = DB::table('valor_leite_mensal')
                        ->join('tipo_produtor','valor_leite_mensal.tipo_produtor_id','tipo_produtor.id')
                        ->where('valor_leite_mensal.data_validade', ">=", date("Y-m-d"))
                        // ->whereBetween('data_referencia', [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                        ->get();


        $tipoProdutores = TipoProdutor::all();

        if(sizeof($valorLeiteMensal) >= 1){
            $page['formulario'] = false;
            $page['message'] = '';

        }else{
            $page['formulario'] = true;
            $page['message'] = 'Não possui valor do leite mensal cadastrado, peça ao administrador que cadadstre para preencher a data de entrega';
        }

        $indices = [];

        foreach($valorLeiteMensal as $valorLeite){
            if(!in_array($valorLeite->tipo_produtor_id, $indices )){
                array_push($indices, $valorLeite->tipo_produtor_id);
            }
        }

        $produtores = DB::table('produtor')->whereIn('produtor.tipo_produtor_id',$indices)->get();

        $entregas = DB::table('relacao_leite_produtor_tanque')
                       ->join('produtor','relacao_leite_produtor_tanque.produtor_id','produtor.id')
                       ->join('periodo','relacao_leite_produtor_tanque.periodo_id','periodo.id')
                       ->join('valor_leite_mensal','relacao_leite_produtor_tanque.valor_leite_mensal_id','valor_leite_mensal.id')
                       ->select('relacao_leite_produtor_tanque.id as rlpt_id', 'relacao_leite_produtor_tanque.*', 'produtor.*','periodo.*','valor_leite_mensal.*')
                       ->orderBy('relacao_leite_produtor_tanque.data_entrega', 'DESC')
                       ->paginate(10);

        return view('view.CadastroLeiteProdutor', compact('response','permission','page','periodos','produtores','fonteTanques','entregas'));
    }



    public function saidaLeite(){
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'CadastroLeiteCliente';

        $periodos = Periodo::all();
        $fonteTanques = FonteTanque::all();

        $valorLeiteMensal = DB::table('valor_leite_mensal')
                        ->join('tipo_produtor','valor_leite_mensal.tipo_produtor_id','tipo_produtor.id')
                        ->where('valor_leite_mensal.data_validade', ">=", date("Y-m-d"))
                        ->select('valor_leite_mensal.id as idValor',
                                 'valor_leite_mensal.data_inclusao',
                                 'valor_leite_mensal.data_validade',
                                 'valor_leite_mensal.valor_bruto',
                                 'valor_leite_mensal.valor_liquido',
                                 'valor_leite_mensal.tipo_produtor_id',
                                 'valor_leite_mensal.usuario',
                                 'tipo_produtor.id',
                                 'tipo_produtor.tipo_valor',
                                 'tipo_produtor.desc_valor',
                                 'tipo_produtor.datahora_inclusao',
                                 'tipo_produtor.datahora_atualizacao',
                                 'tipo_produtor.usuario'
                                 )
                        // ->whereBetween('data_referencia', [ Helpers::dataCorteInicioMes(), Helpers::dataCorteFimMes()])
                        ->get();


        $tipoProdutores = TipoProdutor::all();
        $page['formulario'] = false;
        // if(sizeof($valorLeiteMensal) >= 1){
        //     $page['formulario'] = false;
        //     $page['message'] = '';

        // }else{
        //     $page['formulario'] = true;
        //     $page['message'] = 'Não possui valor do leite mensal cadastrado, peça ao administrador que cadadstre para preencher a data de entrega';
        // }

        $indices = [];

        foreach($valorLeiteMensal as $valorLeite){
            if(!in_array($valorLeite->tipo_produtor_id, $indices )){
                array_push($indices, $valorLeite->tipo_produtor_id);
            }
        }

        $empresas = DB::table('cliente_empresa')->get();

        $entregas = DB::table('relacao_leite_cliente_empresa')
                       ->join('cliente_empresa','relacao_leite_cliente_empresa.cliente_empresa_id','cliente_empresa.id')
                       ->join('periodo','relacao_leite_cliente_empresa.periodo_id','periodo.id')
                       ->join('valor_leite_mensal','relacao_leite_cliente_empresa.valor_leite_mensal_id','valor_leite_mensal.id')
                       ->select('relacao_leite_cliente_empresa.id as rlpt_id', 'relacao_leite_cliente_empresa.*', 'cliente_empresa.*','periodo.*','valor_leite_mensal.*')
                       ->orderBy('relacao_leite_cliente_empresa.data_entrega', 'DESC')
                       ->paginate(10);

        return view('view.CadastroLeiteCliente', compact('response','permission','page','periodos','empresas','fonteTanques','entregas','valorLeiteMensal'));
    }


    public function inserirSaidaLeiteCliente (Request $request){
        if(Auth::check()){
            if(UserHelper::hasAdm() || UserHelper::hasFunc()){
              
                $userLogado = UserHelper::getDataUserLogged()['name'];

                $ValorLeite = ValorLeiteMensal::where('data_validade', ">=", date("Y-m-d"))
                                ->where('id',$request->input('valor-leite-mensal-id'))
                                ->first();

                $acaoLeite = TipoAcaoLeite::where('tipo_acao_valor','SAIDA')->first();
                $FonteTanque = FonteTanque::find( $request->input('fonte-tanque'));
                
                DB::beginTransaction();

                try{

                    
                    $leiteProdutorTanque =  DB::table('relacao_leite_cliente_empresa')->insertGetId([
                        'data_entrega' =>  $request->input('data-entrega'),
                        'qntd_litros_entregue' =>$request->input('quantidade-litros-leite') ,
                        'periodo_id' =>$request->input('periodo-id'),
                        'cliente_empresa_id' => $request->input('cliente-id'),
                        'datahora_inclusao' => new \DateTime(),
                        'datahora_atualizacao' =>new \DateTime(),
                        'valor_leite_mensal_id' => $ValorLeite['id'] ,
                        'usuario' =>  $userLogado,
                ]);

                    DB::table('tanque_leite_associacao')->insert([
                        'fonte_id' =>  $request->input('fonte-tanque'),
                        'tipo_acao_leite_id' => $acaoLeite->id,
                        'total_leite_acao' => $request->input('quantidade-litros-leite'),
                        'relacao_leite_cliente_empresa_id' =>  $leiteProdutorTanque,
                        'usuario' => $userLogado,
                        'datahora_inclusao' => new \DateTime() ,
                        'datahora_atualizacao' =>  new \DateTime(),
                    ]);
                   
                    DB::table('fonte_tanque')
                    ->where('id',$FonteTanque->id)
                    ->update(['total_leite'=>$FonteTanque->total_leite-$request->input('quantidade-litros-leite'),
                            'datahora_atualizacao'=> new \DateTime(),
                            'usuario' => $userLogado ]);

                DB::commit();

                }catch(Exception $e){
                    DB::rollBack();

                    dd($e);
                    echo 'Erro ao inserir leite diario na base comunique ao administrador';
                }

                return back();
            }
            return back();
        }else{
            return back();
        }
    }

}
