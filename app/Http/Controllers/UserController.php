<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Models\TipoUsuario;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // index – Lista os dados da tabela
    // show – Mostra um item específco
    // create – Retorna a View para criar um item da tabela
    // store – Salva o novo item na tabela
    // edit – Retorna a View para edição do dado
    // update – Salva a atualização do dado
    // destroy – Remove o dado

    public function auth(Request $request){
        try{

            if(Auth::attempt(['cpf'=>Helpers::removerMapaCpf($request->input('cpf')), 'password' => $request->password])){
                return redirect()->action([HomeController::class, 'index']);
            }else{
                $erro['message'] = 'DADOS INVALIDO';
                return redirect('/login')->with('message','Dados Inválidos!');
            }
        }catch(Exception $e){
            return redirect('/login')->with('message','Dados Inválidos!');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function edit(){

        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'usuario';

        $users = DB::table('users')
                    ->join('tipo_usuario','users.tipo_usuario_id','=','tipo_usuario.id')
                    ->select('users.id','name', 'email','created_at as inclusao','tipo_usuario.tipo_valor as perfil','cpf')
                    ->orderBy('id', 'asc')
                    ->paginate(10);
        return view('view.CadastroUsuario', compact('response','users','permission','page'));
    }

    public function cadastrar(Request $request){
        $this->store($request);
        return back();
    }

    public function destroy(Request $request){

        if(Auth::check()){
             if(UserHelper::hasAdm()){
                // dd($request->input('id_usuario'));
                DB::table('users')->where('id','=',$request->input('id_usuario'))->delete();
                return back();
            }
            return back();
        }else{
            return back();
        }

    }

    public function store(Request $request){
        if(UserHelper::hasAdm()){
            try{
                DB::table('users')->insert([
                    'name' => $request->input('name'),
                    'email' => strtolower($request->input('email')),
                    'cpf' => Helpers::removerMapaCpf($request->input('cpf')),
                    'password'=>Hash::make($request->input('password')),
                    'created_at'=>new \DateTime(),
                    'updated_at'=>new \DateTime(),
                    'tipo_usuario_id' => $request->input('perfil'),
                ]);
            }catch(Exception $e){
                return redirect('/user/formulario')->with('message','CPF já inseridos no sistema!');
            }
        }
        return back();
    }

    public function alterar($id){
        if(UserHelper::hasAdm()){
            try{
                $response = UserHelper::getDataUserLogged();
                $permission = TipoUsuario::find($response['tipo_usuario_id']);
                $page['info'] = 'edicaoUsuario';
                $edit = User::find($id);
                return view('view.alteracao.EdicaoUsuario', compact('response','permission','page','edit'));
            }catch(Exception $e){
                return back();
            }
        }
        return back();

        return;
    }
    public function atualizaUsuario(Request $request){
        if(UserHelper::hasAdm()){

            $userOriginal = User::find( $request->input('id'));

            try{

                DB::table('users')
                    ->where('id',$request->input('id'))
                    ->update([
                        'name' => empty($request->input('name'))? $userOriginal->name : $request->input('name'),
                        'email' => empty($request->input('email'))? $userOriginal->email : strtolower($request->input('email')),
                        'cpf' => empty($request->input('cpf'))? $userOriginal->cpf : Helpers::removerMapaCpf($request->input('cpf')),
                        'password'=>empty($request->input('password'))? $userOriginal->password : Hash::make($request->input('password')),
                        'updated_at'=>new \DateTime(),
                        'tipo_usuario_id' => empty($request->input('perfil'))? $userOriginal->tipo_usuario_id : $request->input('perfil'),
                    ]);
            }catch(Exception $e){
                dd('erro');
                return redirect('/user/formulario')->with('message','Não foi possivel atualizar os dados verifique novamente');
            }
        }
        return redirect()->route('userFormulario');
    }

}
