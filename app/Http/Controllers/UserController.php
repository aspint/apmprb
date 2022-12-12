<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

class UserController extends Controller
{

    public function index(){
        return view('login');
    }

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
}
