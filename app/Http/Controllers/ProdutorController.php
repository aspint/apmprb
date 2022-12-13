<?php

namespace App\Http\Controllers;

use App\Helper\UserHelper;
use App\Models\Produtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdutorController extends Controller
{


   public function edit(){
    $page['info'] = 'produtor';

    $response = UserHelper::getDataUserLogged();
    $produtores = DB::table('produtor')
                ->join('tipo_produtor','produtor.tipo_produtor_id','=','tipo_produtor.id')
                ->leftjoin('endereco','produtor.id','=','endereco.id')
                ->select('produtor.id','nome', 'cpf_cnpj','produtor.datahora_inclusao as inclusao','tipo_produtor.desc_valor as tipo',
                         'produtor.rg','inscricao','produtor.users_id')
                ->orderBy('id', 'asc')
                ->paginate(5);
    $indices = [];
    foreach($produtores as $produtor){
        array_push($indices, $produtor->users_id);
    }

    $users = DB::table('users')
                ->whereNotIn('users.id', $indices)
                ->get();

    return view('view.cadastroProdutor', compact('response','produtores','page','users'));

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
}
