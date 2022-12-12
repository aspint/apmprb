<?php

namespace App\Http\Controllers;

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
            $user = Auth::user();
            $response['id'] = $user->id;
            $response['email'] = $user->email;
            $response['name'] = $user->name;
            $response['name'] = $user->name;
            return view('view.home', compact('response'));
        }else{
            return view('home');
        }
    }

}
