<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('login');
    }

    public function validation(Request $request){

        if(Auth::attempt(['email'=>$request->email, 'password' => $request->password])){
            return view('layout.home');
        }else{
            dd('voce não esta logado');
        }

    }
}
