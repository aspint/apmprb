<?php

namespace App\Http\Controllers;

use App\Helper\UserHelper;
use App\Models\ClienteEmpresa;
use App\Models\TipoUsuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteEmpresaControler extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    // index – Lista os dados da tabela
    public function index(){
        return ClienteEmpresa::get();
    }

    // show – Mostra um item específco
    public function show($id){
        if(UserHelper::hasAdm()){
            return ClienteEmpresa::find($id);
        }else{
            return back();
        }

    }

    // destroy – Remove o dado
    public function destroy(Request $request){

    }

    // update – Salva a atualização do dado
    public function update(Request $request){
        if(UserHelper::hasAdm()){

            $clienteOriginal =  ClienteEmpresa::find($request->input('id'));

            try{

                DB::table('cliente_empresa')
                    ->where('id',$request->input('id'))
                    ->update([

                        'nome_razao_social' => empty($request->input('nome')) ? $clienteOriginal->name : $request->input('nome'),
                        'cpf_cnpj' => empty($request->input('cnpj')) ? $clienteOriginal->name : $request->input('nome'),
                        // 'endereco_id' => empty($request->input('nome')) ? $clienteOriginal->name : $request->input('nome'),
                        'datahora_atualizacao' => new \DateTime(),
                        'usuario' => UserHelper::getNameUserLogged(),
                    ]);
            }catch(Exception $e){
                dd('erro');
                return redirect('/cliente/formulario')->with('message','Não foi possivel atualizar os dados verifique novamente');
            }
        }
        return redirect()->route('formularioCadastroCliente');

    }

    // store – Salva o novo item na tabela
    public function store(Request $request){

    }

    // create – Retorna a View para criar um item da tabela
    public function create(Request $request){

        if(UserHelper::hasAdm()){
            $page['info'] = 'CadastroCliente';
            $response = UserHelper::getDataUserLogged();
            $permission = TipoUsuario::find($response['tipo_usuario_id']);


            return view('view.CadastroClienteEmpresa', compact('page','response','permission'));
        }else{
            return view('home');
        }

    }

    // edit – Retorna a View para edição do dado
    public function edit(Request $request){

    }


}
