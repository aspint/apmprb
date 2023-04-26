<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\ClienteEmpresa;
use App\Models\TipoUsuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                return redirect('/cliente/formulario')->with('message','Não foi possivel atualizar os dados verifique novamente');
            }
        }
        return redirect()->route('formularioCadastroCliente');

    }

    // store – Salva o novo item na tabela
    public function store(Request $request){

        if(Auth::check()){
            if(UserHelper::hasAdm()){

                DB::beginTransaction();

                try{
                    $idEndereco = null;
                    if($request->input('enderecoClienteCheck') == true){
                        $idEndereco = DB::table('endereco')->insertGetId([
                            'rua' =>  $request->input('rua') != null ? $request->input('rua'): null,
                            'numero' => $request->input('numero') != null ? $request->input('numero') : null,
                            'bairro' => $request->input('bairro')!= null  ? $request->input('bairro'): null,
                            'cidade' =>  $request->input('cidade')!= null ? $request->input('cidade'): null,
                            'estado' => $request->input('uf')!= null ? $request->input('uf')!= null: null,
                            'cep' => $request->input('cep')!= null ? $request->input('cep'): null,
                            'datahora_inclusao' => new \DateTime(),
                            'datahora_atualizacao' => new \DateTime(),
                            'usuario' => UserHelper::getNameUserLogged() != null ? UserHelper::getNameUserLogged() : null,
                        ]);
                    }

                    $idCliente = DB::table('cliente_empresa')->insertGetId([
                        'nome_razao_social' =>  $request->input('nome_razao_social'),
                        'cpf_cnpj' =>Helpers::removerMapaCpf( $request->input('cpf_cnpj')),
                        'endereco_id' => $idEndereco,
                        'datahora_inclusao' => new \DateTime(),
                        'datahora_atualizacao' => new \DateTime(),
                        'usuario' => UserHelper::getNameUserLogged(),
                    ]);


                    DB::commit();
                }catch(Exception $e){
                    DB::rollBack();
                    dd($e);
                    return redirect('/cliente/formulario')->with('message','erro ao inserir na base informe ao desenvolvedor');
                    // echo "erro ao inserir na base informe ao desenvolvedor";
                }

                return back();
            }
            return back();
        }else{
            return back();
        }

        // if(UserHelper::hasAdm()){

        // }else{
        //     return view('home');
        // }
    }

    // create – Retorna a View para criar um item da tabela
    public function create(Request $request){

        if(UserHelper::hasAdm()){
            $page['info'] = 'CadastroCliente';
            $response = UserHelper::getDataUserLogged();
            $permission = TipoUsuario::find($response['tipo_usuario_id']);

            $clientes = ClienteEmpresa::all();
            return view('view.CadastroClienteEmpresa', compact('page','response','permission','clientes'));
        }else{
            return view('home');
        }

    }

    // edit – Retorna a View para edição do dado
    public function edit(Request $request){

    }


}
