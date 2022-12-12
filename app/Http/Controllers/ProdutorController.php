<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdutorController extends Controller
{
   public function edit(){
    $user = Auth::user();
    $response['id'] = $user->id;
    $response['email'] = $user->email;
    $response['name'] = explode(' ',$user->name)[0];
    $response['name_full'] = $user->name;

    $produtores = DB::table('produtor')
                // ->join('tipo_usuario','users.tipo_usuario_id','=','tipo_usuario.id')
                // ->select('users.id','name', 'email','created_at as inclusao','tipo_usuario.tipo_valor as perfil')
                ->orderBy('id', 'asc')
                ->paginate(5);
    return view('view.cadastroProdutor', compact('response','produtores'));
   }
}
