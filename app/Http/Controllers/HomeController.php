<?php

namespace App\Http\Controllers;

use App\Helper\UserHelper;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if(Auth::check()){
            $page['info'] = 'home';
            $response = UserHelper::getDataUserLogged();
            $permission = TipoUsuario::find($response['tipo_usuario_id']);
            return view('view.home', compact('response','page','permission'));
        }else{
            return view('home');
        }
    }
}
