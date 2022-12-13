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
            $page['info'] = 'home';
            $user = Auth::user();
            $response['id'] = $user->id;
            $response['email'] = $user->email;
            $response['name'] = explode(' ',$user->name)[0];
            $response['name_full'] = $user->name;
            return view('view.home', compact('response','page'));
        }else{
            return view('home');
        }
    }
}
