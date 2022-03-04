<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        if(empty(Session::get('user')))
        {
            return view('login.login');
        }
        else
        {
     
            return view('inicio.index');

            //return redirect('menu',$datos); 

        //return view('inicio.index');
    }
}
public function menu()
{
   
}
}
