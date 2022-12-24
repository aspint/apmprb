<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserHelper
{
    public static function getDataUserLogged(){
        $user = Auth::user();
        $response['id'] = $user->id;
        $response['email'] = $user->email;
        $response['cpf'] = $user->cpf;
        $response['name'] = explode(' ',$user->name)[0];
        $response['name_full'] = $user->name;
        $response['tipo_usuario_id'] = $user->tipo_usuario_id;
        return $response;
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

    public function hasFunc(){
        $user = Auth::user();
        $userPerfil = DB::table('users')
            ->join('tipo_usuario','users.tipo_usuario_id','=','tipo_usuario.id')
            ->select('users.id','name', 'email','created_at as inclusao','tipo_usuario.tipo_valor as perfil')
            ->where('users.id',$user->id)
            ->first();
        if($userPerfil->perfil == 'FUNC'){
            return true;
        }else{
            return false;
        }
    }

    public function getNameUserLogged(){
        $user = Auth::user();
        return $user->name;
   }
}
