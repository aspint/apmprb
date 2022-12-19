<?php

namespace App\Http\Controllers;

use App\Helper\UserHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function auth(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password' => $request->password])){
            return redirect()->action([HomeController::class, 'index']);
        }else{
            $erro = 'DADOS INVALIDO';
            return redirect('/login')->with($erro);
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
                    ->select('users.id','name', 'email','created_at as inclusao','tipo_usuario.tipo_valor as perfil')
                    ->orderBy('id', 'asc')
                    ->paginate(5);
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
            DB::table('users')->insert([
                'name' => $request->input('name'),
                'email' => strtolower($request->input('email')),
                'password'=>Hash::make($request->input('password')),
                'created_at'=>new \DateTime(),
                'updated_at'=>new \DateTime(),
                'tipo_usuario_id' => $request->input('perfil'),
            ]);
        }
        return back();
    }


}
