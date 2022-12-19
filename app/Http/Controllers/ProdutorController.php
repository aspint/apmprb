<?php

namespace App\Http\Controllers;

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
        $RelatorioLeiteProdutor = null;

        $DataCorteInicio = Date('01'.'/'.Date('m').'/'.Date('Y'));
        // $DataCorteFim = Date('d/m/Y');
        $DataCorteFim = Date(Date("t", mktime(0,0,0,Date('m'),'01',Date('Y'))).'/'.Date('m').'/'.Date('Y'));
        // dd('Inicio: '. $DataCorteInicio.' FIM: '. $DataCorteFim);
        if($permission->tipo_valor == 'PROD'){
            $this->RelatorioLeiteProdutor = DB::table('relacao_leite_produtor_tanque')
                                            ->join('produtor','relacao_leite_produtor_tanque.produtor_id','produtor.id')
                                            ->where('produtor.users_id',$response['id'])
                                            ->whereBetween('data_entrega', [ $DataCorteInicio, $DataCorteFim])
                                            // ->whereBetween('data_entrega',
                                            //             [ `to_timestamp($DataCorteInicio , 'DD-MM-YYYY')`,
                                            //             `to_timestamp($DataCorteFim, 'DD-MM-YYYY')`])
                                            ->get();
        }
        return view('view.RelatorioLeiteProdutor',compact('response','page','permission','RelatorioLeiteProdutor'));
   }


}
