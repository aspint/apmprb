<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('login');
    }

    public function auth(Request $request){


        if(Auth::attempt(['email'=>$request->email, 'password' => $request->password])){
            return redirect('/home');
        }else{
            dd('voce não esta logado');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
