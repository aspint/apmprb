<?php

namespace App\Http\Controllers;

use App\Helper\UserHelper;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class WikiVideoController extends Controller
{
    public function videoPlay($id){
        $response = UserHelper::getDataUserLogged();
        $permission = TipoUsuario::find($response['tipo_usuario_id']);
        $page['info'] = 'WikiVideo';
        $video = $id;


        return view('view.WikiVideo',compact('response','page','permission','video'));
    }

}
