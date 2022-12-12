<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
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

        $user = Auth::user();
        $response['id'] = $user->id;
        $response['email'] = $user->email;
        $response['name'] = $user->name;
        $response['name_full'] = $user->name;

        $users = DB::table('users')
                    ->join('tipo_usuario','users.tipo_usuario_id','=','tipo_usuario.id')
                    ->select('users.id','name', 'email','created_at as inclusao','tipo_usuario.tipo_valor as perfil')
                    ->orderBy('id', 'asc')
                    ->get();
        return view('view.cadastroUsuario', compact('response','users'));
    }

    public function cadastrar(Request $request){
        $this->store($request);
        return back();
    }

    public function destroy(Request $request){

        if(Auth::check()){
             if($this->hasAdm()){
                // dd($request->input('id_usuario'));
                DB::table('users')->where('id','=',$request->input('id_usuario'))->delete();
                return back();
            }

        }else{
            return back();
        }

    }

    public function store(Request $request){
        if($this->hasAdm()){
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


    public function hasAdm(){
        $user = Auth::user();
        $userPerfil = DB::table('users')
            ->join('tipo_usuario','users.tipo_usuario_id','=','tipo_usuario.id')
            ->select('users.id','name', 'email','created_at as inclusao','tipo_usuario.tipo_valor as perfil')
            ->where('users.id',$user->id)
            ->first();
        if($userPerfil->perfil == 'ADM'){
            return true;
        }else{
            return false;
        }
    }


}
