<?php

namespace App\Http\Controllers;

use App\Helper\Helpers;
use App\Helper\UserHelper;
use App\Models\FonteTanque;
use App\Models\TanqueLeiteAssociacao;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TanqueLeiteAssociacaoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(Auth::check()){
            $page['info'] = 'cadastroTanqueLeite';
            $response = UserHelper::getDataUserLogged();
            $permission = TipoUsuario::find($response['tipo_usuario_id']);

            $FonteTanqueLeite = DB::table('fonte_tanque')
                                    ->orderBy('id')
                                    ->paginate(10);

            // dd($Leite->recebido);
            // $dashboard['qntdLeite']= [,,];

            return view('view.CadastroTanqueLeite', compact('response','page','permission','FonteTanqueLeite'));
        }else{
            return view('home');
        }
        return $this;
    }
    public function show(){
        return $this;
    }



    public function create( Request $request){
        if(Auth::check()){
            if(UserHelper::hasAdm()){
                $this->store($request);
                return back();
            }
            return back();
        }else{
            return back();
        }
    }


    private function store(Request $request){

        $valorLimpo =  preg_replace('/[^A-Za-z0-9\-]/', '',  str_replace(' ', '', $request->input('identificacao')));

        DB::table('fonte_tanque')->insert([
            'fonte_valor' => strtoupper($valorLimpo),
            'fonte_descricao' => $request->input('desc'),
            'total_leite' => 0.0,
            'datahora_inclusao' => new \DateTime(),
            'datahora_atualizacao' => new \DateTime(),
            'usuario' => UserHelper::getNameUserLogged(),
        ]);
    }
    public function edit(){
        return $this;
    }
    public function update(){
        return $this;
    }
    public function destroy($id){

        if(Auth::check()){
            if(UserHelper::hasAdm()){

                FonteTanque::destroy($id);
                return back();
            }
            return back();
        }else{
            return back();
        }


        return $this;
    }

    public function leiteEntradaTanque($idUser, $Produtor ,$RelacaoLeiteProdutor, $fonte){


    }

    public function leiteSaidaTanque($idUser, $Produtor ,$RelacaoLeiteProdutor){

    }
}
