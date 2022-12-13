<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteEmpresaControler extends Controller
{
    // index – Lista os dados da tabela
    // show – Mostra um item específco
    // create – Retorna a View para criar um item da tabela
    // store – Salva o novo item na tabela
    // edit – Retorna a View para edição do dado
    // update – Salva a atualização do dado
    // destroy – Remove o dado

    public function index(Request $request){
        $res = DB::table('cliente_empresa')
                ->join('tipo_usuario','users.tipo_usuario_id','=','tipo_usuario.id')
                    ->select('users.id','name', 'email','created_at as inclusao','tipo_usuario.tipo_valor as perfil')
                    ->orderBy('id', 'asc')
                    ->paginate(5);
    }


    public function show(Request $request){

    }


    public function create(Request $request){

    }


    public function store(Request $request){

    }


    public function edit(Request $request){

    }


    public function update(Request $request){

    }


    public function destroy(Request $request){

    }
}
