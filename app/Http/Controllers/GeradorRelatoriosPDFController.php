<?php

namespace App\Http\Controllers;

use App\Enums\StatusReciboEnum;
use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\ReciboPagamento;
use App\Models\StatusRecibo;
use App\Models\TipoUsuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class GeradorRelatoriosPDFController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function gerarRelatorioLeiteMensalPDF(Request $request){

        // $page['info'] = 'relatorioLeiteProdutor';
        $response = UserHelper::getDataUserLogged();
        // $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $data = null;
        $DashboardRelatorioLeiteProdutor = null;
        $RelatorioLeiteProdutor = null;
        $valorMensal = null;

        $produtor = DB::table('produtor')
                            ->join('tipo_produtor','tipo_produtor.id','produtor.tipo_produtor_id')
                            ->where('produtor.users_id', $response['id'])
                            ->first();

        if( $produtor != null ){

            $temp['totalLitros'] = 0;
            $temp['valorLeiteMes'] = 0.0;
            $temp['valorAReceber'] = 0.0;

            $statusRecibo = StatusRecibo::where('valor',StatusReciboEnum::GERADO)
                            ->first();

            $temp['mesReferencia']  = Helpers::dataCorteInicioMesPersonalizado(date('m'));

            $reciboPagamento = ReciboPagamento::where('produtor_id', $produtor->id)
                            ->whereBetween('mes_referencia', [ Helpers::dataCorteInicioMesPersonalizado(date('m')), Helpers::dataCorteFimMesPersonalizado(date('m'))])
                            ->where('status_recibo_id', $statusRecibo['id'])
                            ->first();

            $temp['totalLitros'] =  $reciboPagamento!= null ? $reciboPagamento['total_litros_pago'] : 0;

            $valorMensal = DB::table('valor_leite_mensal')
                    ->where('valor_leite_mensal.tipo_produtor_id',$produtor->tipo_produtor_id)
                    ->where('valor_leite_mensal.data_validade', ">=", date("Y-m-d"))
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

            $temp['relatoriEntregas'] = $entregas;
            $temp['produtor'] =  $produtor;


            $data = $temp;
            // dd($data);
            $pdf = Pdf::loadView('relatorios.relatorioLeiteDiarioPDF',$data);
            return $pdf->download('RelatorioPDFLeiteDiario.pdf');
        }else{
            return null;
        }
    }

    public function gerarRelatorioLeiteMensalPDFEspecifico(Request $request){

        $response = UserHelper::getDataUserLogged();
        $data = null;
        $valorMensal = null;

        $produtor = DB::table('produtor')
                            ->join('tipo_produtor','tipo_produtor.id','produtor.tipo_produtor_id')
                            ->where('produtor.users_id', $response['id'])
                            ->first();

        if( $produtor != null ){

            $temp['totalLitros'] = 0;
            $temp['valorLeiteMes'] = 0.0;
            $temp['valorAReceber'] = 0.0;

            $statusRecibo = StatusRecibo::where('valor',StatusReciboEnum::GERADO)
                            ->first();

            $temp['mesReferencia']  = Helpers::dataCorteInicioMesPersonalizado(date('m'));

            $reciboPagamento = ReciboPagamento::where('produtor_id', $produtor->id)
                            ->where('id', $request->input('id_recibo'))
                            ->first();


            $temp['totalLitros'] =  $reciboPagamento!= null ? $reciboPagamento['total_litros_pago'] : 0;

            $valorMensal = DB::table('valor_leite_mensal')
                    ->where('valor_leite_mensal.tipo_produtor_id',$produtor->tipo_produtor_id)
                    ->where('valor_leite_mensal.data_validade', ">=", date("Y-m-d"))
                    ->select('valor_leite_mensal.valor_liquido as valor')
                    ->first();


            $temp['valorLeiteMes'] =    $valorMensal != null ? $valorMensal->valor : 0;

            $temp['valorAReceber'] =  $reciboPagamento!= null ?  $reciboPagamento['valor_pago'] : 0;

            $entregas = DB::table('relacao_leite_produtor_tanque')
                    ->join('produtor','relacao_leite_produtor_tanque.produtor_id','produtor.id')
                    ->join('periodo','relacao_leite_produtor_tanque.periodo_id','periodo.id')
                    ->join('valor_leite_mensal','relacao_leite_produtor_tanque.valor_leite_mensal_id','valor_leite_mensal.id')
                    ->where('relacao_leite_produtor_tanque.produtor_id',$produtor->tipo_produtor_id )
                    ->whereBetween('relacao_leite_produtor_tanque.data_entrega',[ $reciboPagamento->periodo_inicio,$reciboPagamento->periodo_fim] )
                    ->select('relacao_leite_produtor_tanque.id as rlpt_id', 'relacao_leite_produtor_tanque.*', 'produtor.*','periodo.*','valor_leite_mensal.*')
                    ->orderBy('relacao_leite_produtor_tanque.data_entrega', 'DESC')
                    ->paginate(20);

            $temp['relatoriEntregas'] = $entregas;
            $temp['produtor'] =  $produtor;


            $data = $temp;
            // dd($data);
            $pdf = Pdf::loadView('relatorios.relatorioLeiteDiarioPDF',$data);
            return $pdf->download('RelatorioPDFLeiteDiario.pdf');
        }else{
            return null;
        }
    }
}
