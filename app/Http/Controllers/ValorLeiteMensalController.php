<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\TipoProdutor;
use App\Models\TipoUsuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ValorLeiteMensalController extends Controller
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
        $page['info'] = 'CadastroValorLeiteMensal';



        $valoresLeite =  DB::table('valor_leite_mensal')
                            ->join('tipo_produtor','valor_leite_mensal.tipo_produtor_id','tipo_produtor.id')
                            ->select('valor_leite_mensal.id as valorLeite_id','valor_leite_mensal.*','tipo_produtor.*')
                            ->orderBy('data_referencia', 'desc')
                            ->paginate(10);


        return view('view.CadastroValorLeiteMensal',compact('response','permission','page','valoresLeite'));
    }


    public function store(Request $request){
        if(Auth::check()){
            if(UserHelper::hasAdm()){
                $tipoProdutor = TipoProdutor::find($request->input('tipo_produtor'));

                $mes =  Date('m',strtotime( $request->input('dataReferencia')));


                $vlrLeitCadasMes  =  DB::table('valor_leite_mensal')
                                        ->join('tipo_produtor','valor_leite_mensal.tipo_produtor_id','tipo_produtor.id')
                                        ->select('valor_leite_mensal.id as valorLeite_id','valor_leite_mensal.*','tipo_produtor.*')
                                        ->where('tipo_produtor.tipo_valor',$tipoProdutor->tipo_valor)
                                        ->whereBetween('valor_leite_mensal.data_referencia',[Helpers::dataCorteInicioMesPersonalizado($mes),Helpers::dataCorteFimMesPersonalizado($mes)])
                                        ->count();

                if($vlrLeitCadasMes > 0){
                    return back()->with('message', 'Não é possivel inserir dois valores, para o mesmo produtor, dentro do mesmo mês');
                }

                DB::table('valor_leite_mensal')->insert([

                    'data_inclusao' => new \DateTime(),
                    'data_referencia' => $request->input('dataReferencia'),
                    'valor_bruto' => $request->input('valorBruto'),
                    'valor_liquido' => $request->input('valorLiquido'),
                    'tipo_produtor_id' =>$request->input('tipo_produtor'),
                    'usuario' =>  UserHelper::getDataUserLogged()['name'],
                ]);

                return back();
            }
            return back();
        }else{
            return back();
        }
    }


    public function destroy(Request $request){

        if(Auth::check()){
            if(UserHelper::hasAdm()){
               // dd($request->input('id_usuario'));
               DB::table('valor_leite_mensal')->where('id','=',$request->input('idValorLeite'))->delete();
               return back();
           }
           return back();
       }else{
           return back();
       }
    }
}
